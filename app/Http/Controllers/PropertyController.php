<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Memanggil model Property

class PropertyController extends Controller
{
    // Fungsi untuk menampilkan Dashboard Utama
    public function index()
    {
        // GANTI angka 1 menjadi auth()->id()
        $properties = Property::with('rooms')->where('user_id', auth()->id())->latest()->get();
        return view('welcome', compact('properties'));
    }

    // Fungsi untuk halaman Manajemen Properti Spesifik
    public function manage($id)
    {
        // Ambil data properti beserta kamarnya, pastikan hanya milik user yang sedang login
        $property = Property::with('rooms')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('manage-property', compact('property'));
    }
    // Fungsi untuk menampilkan halaman Step 1
    public function createStep1()
    {
        return view('add-property');
    }

    // Fungsi untuk memproses data dari Step 1 dan menyimpannya ke database
    public function storeStep1(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'type' => 'required',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048' // Validasi gambar
        ]);

        $property = new Property();
        $property->user_id = auth()->id();
        $property->name = $request->name;
        $property->type = $request->type;
        $property->year_established = $request->year_established;
        $property->description = $request->description;
        $property->facilities = $request->facilities;

        // LOGIKA UNGGAH FOTO
        if ($request->hasFile('photos')) {
            $paths = [];
            foreach ($request->file('photos') as $photo) {
                // Simpan ke folder: storage/app/public/property_photos
                $path = $photo->store('property_photos', 'public');
                $paths[] = $path;
            }
            $property->photos = $paths; // Simpan array path ke database
        }

        $property->save();
        return redirect('/property-cost/' . $property->id);
    }

    public function roomList($id)
    {
        // Ambil properti beserta semua tipe kamar di dalamnya
        $property = Property::with('rooms')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('property-rooms', compact('property'));
    }
    public function occupantList($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('property-occupants', compact('property'));
    }
    // Fungsi untuk memproses data dari Step 2
    public function storeStep2(Request $request, $id)
    {
        // 1. Cari properti yang baru saja dibuat di Step 1 berdasarkan ID
        $property = Property::findOrFail($id);

        // 2. Update data utilitas (listrik, air, deposit) ke tabel properties
        $property->electricity_rule = $request->listrik;
        $property->water_rule = $request->air;
        // Kita hilangkan titik (misal 1.500.000 jadi 1500000) agar aman masuk database
        $property->water_price = $request->water_price ? (int) str_replace('.', '', $request->water_price) : null;
        $property->deposit = $request->deposit ? (int) str_replace('.', '', $request->deposit) : 0;
        $property->save();

        // 3. Simpan data kamar ke tabel rooms
        $room = new \App\Models\Room(); // Panggil model Room
        $room->property_id = $property->id; // Kaitkan kamar ini dengan properti tersebut
        $room->name = $request->room_name;
        $room->size = $request->room_size;
        $room->quantity = $request->room_quantity;
        
        // Cek jika ada input harga sewa (Hapus titiknya juga)
        if ($request->has('price_monthly')) {
            $room->price_monthly = (int) str_replace('.', '', $request->price_monthly);
        }
        if ($request->has('price_daily')) {
            $room->price_daily = (int) str_replace('.', '', $request->price_daily);
        }
        if ($request->has('price_yearly')) {
            $room->price_yearly = (int) str_replace('.', '', $request->price_yearly);
        }

        $room->save();

        // 4. Lanjut ke Step 3 (Pratinjau) dengan membawa ID properti tersebut
        return redirect('/property-publish/' . $property->id);
    }
    // Fungsi untuk menampilkan halaman Step 3 (Pratinjau)
    public function publishStep3($id)
    {
        // Ambil data properti beserta relasi kamarnya berdasarkan ID
        $property = Property::with('rooms')->findOrFail($id);
        
        // Kirim datanya ke halaman property-publish
        return view('property-publish', compact('property'));
    }
    
    public function billingList($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('property-billing', compact('property'));
    }

    public function complainList($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('property-complains', compact('property'));
    }

    public function settings($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('property-settings', compact('property'));
    }

}
