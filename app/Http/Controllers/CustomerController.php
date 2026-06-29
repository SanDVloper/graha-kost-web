<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Billing;
use App\Models\Complaint;
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

        // Cari transaksi sewa aktif terakhir milik user
        $currentBilling = Billing::where('user_id', $userId)
            ->with('property')
            ->latest()
            ->first();

        // Jika user belum pernah nge-enroll kosan sama sekali
        if (!$currentBilling) {
            return redirect()->route('customer.index', ['bypass' => true])->with('success', 'Anda belum terdaftar di kos manapun. Silakan pilih salah satu kos di bawah untuk mengajukan sewa!');
        }

        // Jika tagihan sudah di-ACC landlord tapi belum LUNAS dibayar
        if ($currentBilling->status === 'unpaid') {
            return redirect()->route('customer.billing')->with('success', 'Pengajuan sewa Anda telah disetujui! Silakan selesaikan pembayaran tagihan Anda.');
        }

        // Jika masih pending atau rejected
        if ($currentBilling->status !== 'paid') {
            return redirect()->route('customer.index', ['bypass' => true])->with('success', 'Pengajuan sewa Anda saat ini berstatus: ' . $currentBilling->status . '.');
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

        return view('customer.my-kos', compact('property', 'myBillings', 'neighbors', 'currentBilling'));
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

        Billing::create([
            'user_id'     => Auth::id(),
            'property_id' => $propertyId,
            'room_id'     => $roomId,
            'duration'    => $durasi,
            'amount'      => $hargaSewa,
            'status'      => 'pending_approval',
            'due_date'    => Carbon::now()->addDays(3),
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
            'pesan' => 'required|string|min:10',
        ]);

        Complaint::create([
            'user_id'      => Auth::id(),
            'judul'        => 'Komplain Penghuni - ' . Auth::user()->name,
            'isi_komplain' => $request->pesan,
        ]);

        return back()->with('success', 'Keluhan Anda telah diterima dan akan segera diproses.');
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
