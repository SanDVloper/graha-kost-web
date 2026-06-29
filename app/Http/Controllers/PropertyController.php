<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Memanggil model Property

class PropertyController extends Controller
{
    // Fungsi untuk menampilkan Dashboard Utama
    public function index()
    {
        $user = auth()->user();
        $profileIncomplete = false;
        
        if ($user->role === 'tuan_kos') {
            $profileIncomplete = empty($user->phone_number) || empty($user->gender) || empty($user->pekerjaan) ||
                                 empty($user->bank_name) || empty($user->bank_account_number) || empty($user->bank_account_name);
        }

        // GANTI angka 1 menjadi auth()->id()
        $properties = Property::with('rooms')->where('user_id', auth()->id())->latest()->get();
        return view('landlord.welcome', compact('properties', 'profileIncomplete'));
    }

    // Fungsi untuk halaman Manajemen Properti Spesifik
    public function manage($id)
    {
        // Ambil data properti beserta kamarnya, pastikan hanya milik user yang sedang login
        $property = Property::with('rooms')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('landlord.manage-property', compact('property'));
    }
    
    // Fungsi untuk menampilkan halaman Step 1
    public function createStep1()
    {
        return view('landlord.add-property');
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
        $property->garbage_management = $request->garbage_management;
        $property->facilities = $request->facilities;
        $property->rules = $request->rules;

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
        
        return view('landlord.property-rooms', compact('property'));
    }
    
    public function occupantList($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('landlord.property-occupants', compact('property'));
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
        if ($request->has('rooms') && is_array($request->rooms)) {
            foreach ($request->rooms as $roomData) {
                $room = new \App\Models\Room();
                $room->property_id = $property->id;
                $room->name = $roomData['name'] ?? 'Kamar';
                $room->size = $roomData['size'] ?? '-';
                $room->quantity = $roomData['quantity'] ?? 1;
                
                // Simpan fasilitas (Laravel akan otomatis encode menjadi JSON karena casts di Model)
                if (isset($roomData['facilities'])) {
                    $room->facilities = $roomData['facilities'];
                }

                // Cek jika ada input harga sewa (Hapus titiknya juga)
                if (!empty($roomData['price_monthly'])) {
                    $room->price_monthly = (int) str_replace('.', '', $roomData['price_monthly']);
                }
                if (!empty($roomData['price_daily'])) {
                    $room->price_daily = (int) str_replace('.', '', $roomData['price_daily']);
                }
                if (!empty($roomData['price_yearly'])) {
                    $room->price_yearly = (int) str_replace('.', '', $roomData['price_yearly']);
                }

                $room->save();
            }
        }

        // 4. Lanjut ke Step 3 (Pratinjau) dengan membawa ID properti tersebut
        return redirect('/property-publish/' . $property->id);
    }
    
    // Fungsi untuk menampilkan halaman Step 3 (Pratinjau)
    public function publishStep3($id)
    {
        // Ambil data properti beserta relasi kamarnya berdasarkan ID
        $property = Property::with('rooms')->findOrFail($id);
        
        // Kirim datanya ke halaman property-publish
        return view('landlord.property-publish', compact('property'));
    }
    
    public function billingList($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::with(['billings.user', 'billings.room'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('landlord.property-billing', compact('property'));
    }

    public function verifyPayment(Request $request, $id, $billing_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $billing = \App\Models\Billing::where('id', $billing_id)->where('property_id', $id)->firstOrFail();
        
        $billing->update(['status' => 'paid']);

        // Update role to penghuni
        $user = \App\Models\User::find($billing->user_id);
        if ($user && $user->role !== 'admin') {
            $user->update(['role' => 'penghuni']);
        }
        
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function complainList($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('landlord.property-complains', compact('property'));
    }

    public function settings($id)
    {
        // Ambil data properti untuk memastikan ini milik user yang login
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('landlord.property-settings', compact('property'));
    }

    public function updateSettings(Request $request, $id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $property->name = $request->name;
        $property->type = $request->type;
        $property->description = $request->description;
        $property->garbage_management = $request->garbage_management;
        $property->rules = $request->rules;
        
        $property->save();

        return redirect()->back()->with('success', 'Pengaturan properti berhasil diperbarui!');
    }
    public function applications($id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $applications = \App\Models\Billing::with('user')
            ->where('property_id', $id)
            ->where('status', 'pending_approval')
            ->latest()
            ->get();
            
        return view('landlord.property-applications', compact('property', 'applications'));
    }

    public function acceptApplication(Request $request, $id, $billing_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $billing = \App\Models\Billing::where('id', $billing_id)->where('property_id', $id)->firstOrFail();
        
        $billing->update(['status' => 'unpaid']);
        
        return redirect()->back()->with('success', 'Pengajuan sewa berhasil diterima! Tagihan telah diteruskan ke calon tenant.');
    }

    public function rejectApplication(Request $request, $id, $billing_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $billing = \App\Models\Billing::where('id', $billing_id)->where('property_id', $id)->firstOrFail();
        
        $billing->update(['status' => 'rejected']);
        
        return redirect()->back()->with('success', 'Pengajuan sewa telah ditolak.');
    }
    
    public function storeRoom(Request $request, $id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price_monthly' => 'nullable|numeric|min:0',
            'price_daily' => 'nullable|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'facilities' => 'nullable|array'
        ]);
        
        $validated['property_id'] = $property->id;
        
        \App\Models\Room::create($validated);
        
        return redirect()->back()->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    public function updateRoom(Request $request, $id, $room_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $room = \App\Models\Room::where('id', $room_id)->where('property_id', $property->id)->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price_monthly' => 'nullable|numeric|min:0',
            'price_daily' => 'nullable|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'facilities' => 'nullable|array'
        ]);
        
        // Ensure facilities is always an array even if unchecked all
        if (!isset($validated['facilities'])) {
            $validated['facilities'] = [];
        }
        
        $room->update($validated);
        
        return redirect()->back()->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function deleteRoom($id, $room_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $room = \App\Models\Room::where('id', $room_id)->where('property_id', $property->id)->firstOrFail();
        
        $room->delete();
        
        return redirect()->back()->with('success', 'Tipe kamar berhasil dihapus.');
    }

    public function deactivate(Request $request, $id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Toggle is_active
        $property->is_active = !$property->is_active;
        $property->save();
        
        $statusStr = $property->is_active ? 'diaktifkan' : 'dinonaktifkan sementara';
        return redirect()->back()->with('success', 'Properti berhasil ' . $statusStr . '.');
    }

    public function destroy($id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Hapus properti
        $property->delete();
        
        return redirect()->route('landlord.dashboard')->with('success', 'Properti berhasil dihapus permanen.');
    }
}