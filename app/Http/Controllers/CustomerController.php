<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Billing;
use App\Models\Complaint;
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

        $properties = $query->latest()->get();

        return view('customer.index', compact('properties'));
    }

    /**
     * Fitur 2: Ajukan Sewa (Enroll)
     */
    public function enroll(Request $request)
    {
        $propertyId = $request->input('property_id');
        $property = Property::with('rooms')->findOrFail($propertyId);

        // MATCHING LOGIC: Disamakan persis dengan rumus hitungan halaman depan kelompokmu
        if ($property->rooms && $property->rooms->count() > 0) {
            $hargaSewa = $property->rooms->first()->price_monthly;
        } else {
            $hargaSewa = 600000;
            if($property->type == 'putri') $hargaSewa = 850000;
            if($property->type == 'putra') $hargaSewa = 750000;
            if(str_contains(strtolower($property->name), 'premium') || str_contains(strtolower($property->name), 'luxury')) {
                $hargaSewa = 1800000;
            } elseif($property->type == 'campur' && $hargaSewa == 600000) {
                $hargaSewa = 1200000;
            }
        }

        // Simpan data pengajuan sewa ke tabel billings
        Billing::create([
            'user_id'     => Auth::id(),
            'property_id' => $propertyId,
            'amount'      => $hargaSewa,
            'status'      => 'unpaid',
            'due_date'    => Carbon::now()->addDays(3),
        ]);

        return redirect()->route('customer.show', $propertyId)->with('success', 'Pengajuan sewa ' . $property->name . ' berhasil diajukan! Tagihan baru telah dibuat, silakan cek menu Billing untuk melakukan pembayaran.');
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
    $billing = Billing::findOrFail($id);
    $billing->update(['status' => 'paid']);

    $user = \App\Models\User::find(Auth::id());
    if ($user && $user->role !== 'admin') {
        $user->update(['role' => 'penghuni']);
    }

    // PERBAIKAN: Sertakan id billing ke session agar tombol kuitansi otomatis muncul
    return back()->with([
        'success' => 'Pembayaran berhasil dikonfirmasi. Selamat! Status Akun Anda kini aktif sebagai Penghuni Kos.',
        'invoice_id' => $id
    ]);
}
public function invoice($id)
{
    // Mengambil data tagihan lunas beserta properti kos yang bersangkutan
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
            'property_id' => 'required',
            'rating'      => 'required|integer|min:1|max:5',
            'ulasan'      => 'nullable|string'
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    /**
     * Fitur Detail Kos
     */
    public function show($id)
    {
        $property = Property::with('rooms')->findOrFail($id);
        return view('customer.show', compact('property'));
    }
}
