<?php

namespace App\Http\Controllers;

use App\Models\Property; // Diselaraskan menggunakan model Property milik Tuanku
use App\Models\Billing; // Asumsi model ini sudah ada
use App\Models\Complaint; // Asumsi model ini sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Fitur 1: Jelajah (Eksplorasi & Pencarian)
     * Hak Akses: Guest (Tamu) & Pencari & Penghuni
     */
    public function index(Request $request)
    {
        // Menggunakan model Property
        $query = Property::query();

        // Filter berdasarkan pencarian nama atau deskripsi
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                // Kolom disesuaikan dengan database Property Tuanku
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kategori (Putra/Putri/Campur)
        if ($request->filled('kategori')) {
            $query->where('type', $request->kategori); // Kolom 'type' dari PropertyController
        }

        $properties = $query->get();

        // Diarahkan ke folder customer
        return view('customer.index', compact('properties'));
    }

    /**
     * Fitur 2: Detail Kos
     * Hak Akses: Guest (Tamu) & Pencari & Penghuni
     */
    public function show($id)
    {
        // Menarik data properti beserta relasi kamarnya
        $property = Property::with('rooms')->findOrFail($id);
        
        return view('customer.show', compact('property'));
    }

    /**
     * Fitur 3: Enroll (Proses Booking)
     * Hak Akses: KHUSUS PENCARI (Role: pencari)
     */
    public function enroll(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id', // Validasi ke tabel properties
        ]);

        // TODO: Simpan data pendaftaran ke tabel transaksi/enrollment
        // Contoh: Enrollment::create([...]);

        return redirect()->route('customer.index')
            ->with('success', 'Permintaan booking berhasil dikirim! Silakan tunggu konfirmasi pemilik.');
    }

    /**
     * Fitur 4: Billing (Daftar Tagihan)
     * Hak Akses: KHUSUS PENGHUNI (Role: penghuni)
     */
    public function billing()
    {
        // Mengambil tagihan milik user yang sedang login
        $billings = Billing::where('user_id', Auth::id())->get();

        return view('customer.billing', compact('billings'));
    }

    /**
     * Fitur 5: Proses Bayar
     * Hak Akses: KHUSUS PENGHUNI (Role: penghuni)
     */
    public function pay(Request $request, $id)
    {
        $billing = Billing::findOrFail($id);
        $billing->update(['status' => 'paid']);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * Fitur 6: Komplain
     * Hak Akses: KHUSUS PENGHUNI (Role: penghuni)
     */
    public function complain(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|min:10',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'pesan' => $request->pesan,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Keluhan Anda telah diterima dan akan segera diproses.');
    }

    /**
     * Fitur 7: Rating & Review
     * Hak Akses: KHUSUS PENGHUNI (Role: penghuni)
     */
    public function rate(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            'rating' => 'required|integer|min:1,max:5',
            'ulasan' => 'nullable|string'
        ]);

        // TODO: Simpan ke tabel ratings

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}