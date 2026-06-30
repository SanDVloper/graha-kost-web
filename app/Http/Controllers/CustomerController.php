<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Billing;
use App\Models\Complaint;
use App\Models\Complain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Fitur 1: Jelajah (Eksplorasi & Pencarian)
     */
    public function index(Request $request)
    {
        // 🟢 KEMBALI NORMAL: Menghapus auto-redirect agar halaman katalog cari-kos bisa diakses kembali oleh publik/guest
        $query = Property::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('type', strtolower($request->kategori));
        }

        $properties = $query->with('rooms')->latest()->get();

        return view('customer.index', compact('properties'));
    }

    /**
     * Fitur Baru: Menampilkan detail kosan yang dihuni, tagihan, dan tetangga kamar
     */
    public function myKos()
    {
        $userId = Auth::id();
        $user   = Auth::user();

        // Jika role bukan penghuni, redirect ke cari kos
        if ($user->role !== 'penghuni') {
            return redirect()->route('customer.index', ['bypass' => true])
                ->with('info', 'Anda belum terdaftar sebagai penghuni. Silakan ajukan sewa terlebih dahulu.');
        }

        // Cari tagihan terbaru user di kos manapun
        $currentBilling = Billing::where('user_id', $userId)
            ->with(['property', 'room'])
            ->latest()
            ->first();

        // Tidak ada tagihan sama sekali (data tidak konsisten)
        if (!$currentBilling) {
            return redirect()->route('customer.index', ['bypass' => true])
                ->with('info', 'Data tagihan tidak ditemukan. Hubungi pengelola kos Anda.');
        }

        // Tagihan ada tapi belum dibayar (status pending) → arahkan ke halaman bayar
        if (in_array($currentBilling->status, ['pending', 'unpaid'])) {
            return redirect()->route('customer.billing')
                ->with('info', 'Selamat! Pengajuan sewa Anda telah disetujui. Silakan selesaikan pembayaran tagihan awal Anda.');
        }

        $property = $currentBilling->property;

        // Ambil semua tagihan khusus properti ini milik user
        $myBillings = Billing::where('user_id', $userId)
            ->where('property_id', $property->id)
            ->latest()
            ->get();

        // Cari data tetangga: ambil user lain yang nge-kos di properti bangunan yang sama
        $neighbors = Billing::where('property_id', $property->id)
            ->where('user_id', '!=', $userId)
            ->with('user')
            ->get()
            ->unique('user_id');

        // Fetch public complaints (Papan Pengumuman) for this property
        $publicComplains = Complain::where('property_id', $property->id)
            ->where('visibility', 'public')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.my-kos', compact('property', 'myBillings', 'neighbors', 'currentBilling', 'publicComplains'));
    }

    /**
     * Fitur 2: Ajukan Sewa (Enroll)
     */
    public function enroll(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'room_id' => 'required|exists:rooms,id',
            'durasi_sewa' => 'required|in:harian,bulanan,tahunan'
        ]);

        $propertyId = $request->input('property_id');
        $roomId = $request->input('room_id');
        $durasi = $request->input('durasi_sewa');

        $property = Property::findOrFail($propertyId);
        $room = \App\Models\Room::findOrFail($roomId);

        if ($durasi == 'harian') {
            $hargaSewa = $room->price_daily ?? round($room->price_monthly / 20);
        } elseif ($durasi == 'tahunan') {
            $hargaSewa = $room->price_yearly ?? ($room->price_monthly * 11);
        } else {
            $hargaSewa = $room->price_monthly;
        }

        \App\Models\Application::create([
            'user_id'     => Auth::id(),
            'property_id' => $propertyId,
            'room_id'     => $roomId,
            'duration'    => $durasi,
            'status'      => 'menunggu', // Default status for application
            'start_date'  => Carbon::now()->addDays(1),
        ]);

        return redirect()->route('customer.show', $propertyId)->with('success', 'Pengajuan sewa tipe kamar ' . $room->name . ' berhasil diajukan! Menunggu persetujuan dari pemilik kos sebelum Anda dapat melakukan pembayaran.');
    }

    /**
     * Fitur 4: Billing (Daftar Tagihan)
     */
    public function billing()
    {
        $billings = Billing::where('user_id', Auth::id())->latest()->get();
        return view('customer.billing', compact('billings'));
    }

    /**
     * Fitur 5: Proses Bayar
     */
    public function pay(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $billing = Billing::findOrFail($id);

        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $billing->update([
                'bukti_transfer' => $path,
                'status' => 'waiting_verification'
            ]);
        }

        return back()->with([
            'success' => 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi dari pemilik kos.',
        ]);
    }

    /**
     * Fitur 5.1: Proses Bayar Instan via Simulasi QRIS
     */
    public function payQris(Request $request, $id)
    {
        $billing = Billing::findOrFail($id);
        
        // Pastikan tagihan ini milik user yang sedang login
        if ($billing->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        // Karena QRIS otomatis sukses, langsung ubah status jadi paid
        $billing->update([
            'status' => 'paid'
        ]);

        // Update role menjadi penghuni jika sebelumnya adalah pencari
        $user = \App\Models\User::find($billing->user_id);
        if ($user && $user->role !== 'admin' && $user->role !== 'tuan_kos') {
            $user->update(['role' => 'penghuni']);
        }

        return back()->with([
            'success' => 'Pembayaran QRIS Berhasil! Tagihan Anda telah lunas.',
            'invoice_id' => $billing->id
        ]);
    }

    /**
     * Fitur 6: Menampilkan Invoice Kuitansi
     */
    public function invoice($id)
    {
        $billing = Billing::with('property')->findOrFail($id);
        return view('customer.invoice', compact('billing'));
    }

    /**
     * Fitur 6: Komplain
     */
    public function complain(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'pesan' => 'required|string|min:10',
            'visibility' => 'required|in:landlord_only,public'
        ]);

        $userId = Auth::id();
        
        // Find the user's active billing to associate the complaint with the property and room
        $currentBilling = Billing::where('user_id', $userId)
            ->whereIn('status', ['paid', 'waiting_verification', 'pending'])
            ->latest()
            ->first();

        if (!$currentBilling) {
            return back()->withErrors(['pesan' => 'Anda harus menjadi penghuni aktif untuk mengajukan komplain.']);
        }

        Complain::create([
            'user_id'      => $userId,
            'property_id'  => $currentBilling->property_id,
            'room_id'      => $currentBilling->room_id,
            'title'        => $request->title,
            'category'     => $request->category,
            'description'  => $request->pesan,
            'priority'     => 'sedang',
            'status'       => 'menunggu',
            'is_anonymous' => $request->has('is_anonymous'),
            'visibility'   => $request->visibility
        ]);

        return back()->with('success', 'Keluhan Anda telah diterima dan diteruskan ke Tuan Kos.');
    }

    /**
     * Fitur 7: Rating & Review
     */
    public function rate(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'rating'      => 'required|integer|min:1|max:5',
            'ulasan'      => 'nullable|string'
        ]);

        \App\Models\Review::updateOrCreate(
            ['user_id' => Auth::id(), 'property_id' => $request->property_id],
            ['rating' => $request->rating, 'comment' => $request->ulasan]
        );

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    /**
     * Fitur Detail Kos
     */
    public function show($id)
    {
        $property = Property::with(['rooms', 'reviews.user'])->findOrFail($id);
        return view('customer.show', compact('property'));
    }
}
