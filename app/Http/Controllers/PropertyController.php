<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Memanggil model Property

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'tuan_kos') {
                return redirect('/');
            }
            return $next($request);
        });
    }

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

        // LOGIKA UNGGAH FOTO
        $paths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Simpan ke folder: storage/app/public/property_photos
                $path = $photo->store('property_photos', 'public');
                $paths[] = $path;
            }
        }
        
        $time_str = '';
        if ($request->filled('garbage_time_start') && $request->filled('garbage_time_end')) {
            $time_str = $request->garbage_time_start . ' - ' . $request->garbage_time_end . ' WITA';
        } elseif ($request->filled('garbage_time_start')) {
            $time_str = $request->garbage_time_start . ' WITA';
        }

        $propertyData = [
            'name' => $request->name,
            'type' => $request->type,
            'year_established' => $request->year_established,
            'description' => $request->description,
            'garbage_management' => [
                'is_scheduled' => $request->has('garbage_is_scheduled'),
                'days' => $request->input('garbage_days', []),
                'time' => $time_str,
                'message' => $request->garbage_message,
            ],
            'facilities' => $request->facilities,
            'rules' => $request->rules,
            'photos' => $paths,
        ];

        session(['property_step1' => $propertyData]);

        return redirect('/property-cost');
    }

    public function roomList($id)
    {
        // Ambil properti beserta semua tipe kamar di dalamnya
        $property = Property::with('rooms')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        return view('landlord.property-rooms', compact('property'));
    }
    
    public function occupantList($id)
    {
        $property = Property::with(['rooms', 'billings.user', 'billings.room'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Asumsi penghuni aktif adalah user yang memiliki billing dengan status paid / waiting
        $activeOccupants = $property->billings->whereIn('status', ['paid', 'waiting_verification'])->unique('user_id');
        // Mantan penghuni adalah user dengan tagihan berstatus 'ended'
        $inactiveOccupants = $property->billings->where('status', 'ended')->unique('user_id');
        
        return view('landlord.property-occupants', compact('property', 'activeOccupants', 'inactiveOccupants'));
    }
    
    public function evictOccupant(Request $request, $id, $billing_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $billing = \App\Models\Billing::where('id', $billing_id)->where('property_id', $property->id)->firstOrFail();
        
        $billing->status = 'ended';
        $billing->save();

        return redirect()->back()->with('success', 'Penghuni berhasil dihapus dan dipindahkan ke histori Mantan Penghuni.');
    }

    public function moveOccupant(Request $request, $id, $billing_id)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'assigned_room_number' => 'required|string|max:255'
        ]);

        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $billing = \App\Models\Billing::where('id', $billing_id)->where('property_id', $property->id)->firstOrFail();
        
        // Verifikasi bahwa room_id baru memang milik properti ini
        $newRoom = \App\Models\Room::where('id', $request->room_id)->where('property_id', $property->id)->firstOrFail();

        $billing->room_id = $newRoom->id;
        $billing->assigned_room_number = $request->assigned_room_number;
        $billing->save();

        return redirect()->back()->with('success', 'Penghuni berhasil dipindahkan ke kamar baru.');
    }
    
    // Fungsi untuk memproses data dari Step 2
    public function storeStep2(Request $request)
    {
        $step1Data = session('property_step1');
        if (!$step1Data) {
            return redirect('/add-property')->with('error', 'Silakan isi data properti terlebih dahulu.');
        }

        // 1. Buat properti baru dari data Step 1
        $property = new Property();
        $property->user_id = auth()->id();
        $property->name = $step1Data['name'];
        $property->type = $step1Data['type'];
        $property->year_established = $step1Data['year_established'];
        $property->description = $step1Data['description'];
        $property->garbage_management = $step1Data['garbage_management'];
        $property->facilities = $step1Data['facilities'];
        $property->rules = $step1Data['rules'];
        $property->photos = $step1Data['photos'];

        // 2. Update data utilitas (listrik, air, deposit) dari Step 2
        $property->electricity_rule = $request->listrik;
        $property->water_rule = $request->air;
        // Kita hilangkan titik (misal 1.500.000 jadi 1500000) agar aman masuk database
        $property->water_price = $request->water_price ? (int) str_replace('.', '', $request->water_price) : null;
        $property->deposit = $request->deposit ? (int) str_replace('.', '', $request->deposit) : 0;
        
        $property->save();

        session()->forget('property_step1');

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
        $property = Property::with(['billings.user', 'billings.room'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $totalPendapatan = $property->billings->where('status', 'paid')->sum('amount');
        $totalLunas = $property->billings->where('status', 'paid')->count();
        
        $totalMenunggu = $property->billings->where('status', 'waiting_verification')->sum('amount');
        $countMenunggu = $property->billings->where('status', 'waiting_verification')->count();
        
        $totalTertunggak = $property->billings->where('status', 'pending')->where('due_date', '<', now())->sum('amount');
        $countTertunggak = $property->billings->where('status', 'pending')->where('due_date', '<', now())->count();
        
        $countBelumDibayar = $property->billings->where('status', 'pending')->count();
        $countSemua = $property->billings->count();

        return view('landlord.property-billing', compact(
            'property', 'totalPendapatan', 'totalLunas', 
            'totalMenunggu', 'countMenunggu', 
            'totalTertunggak', 'countTertunggak',
            'countBelumDibayar', 'countSemua'
        ));
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
        $property = Property::with(['complains.user', 'complains.room'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $complains = $property->complains()->latest()->get();
        $countMenunggu = $complains->where('status', 'menunggu')->count();
        $countDiproses = $complains->where('status', 'diproses')->count();
        $countSelesai = $complains->where('status', 'selesai')->count();
        $countTotal = $complains->count();
        
        return view('landlord.property-complains', compact('property', 'complains', 'countMenunggu', 'countDiproses', 'countSelesai', 'countTotal'));
    }

    public function broadcastComplain(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        \App\Models\Complain::create([
            'property_id' => $property->id,
            'user_id' => auth()->id(), // Tuan kos
            'title' => $request->title,
            'category' => 'Pengumuman',
            'description' => $request->description,
            'priority' => 'sedang',
            'status' => 'selesai',
            'visibility' => 'public',
            'is_anonymous' => false
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil di-broadcast ke seluruh penghuni.');
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
        
        $time_str = '';
        if ($request->filled('garbage_time_start') && $request->filled('garbage_time_end')) {
            $time_str = $request->garbage_time_start . ' - ' . $request->garbage_time_end . ' WITA';
        } elseif ($request->filled('garbage_time_start')) {
            $time_str = $request->garbage_time_start . ' WITA';
        }

        $property->garbage_management = [
            'is_scheduled' => $request->has('garbage_is_scheduled'),
            'days' => $request->input('garbage_days', []),
            'time' => $time_str,
            'message' => $request->garbage_message,
        ];
        
        $property->rules = $request->rules;
        $property->facilities = $request->facilities;
        
        $property->save();

        return redirect()->back()->with('success', 'Pengaturan properti berhasil diperbarui!');
    }
    public function applications($id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Kita menggunakan tabel applications yang baru dibuat
        $applications = \App\Models\Application::with(['user', 'room'])
            ->where('property_id', $id)
            ->latest()
            ->get();
            
        return view('landlord.property-applications', compact('property', 'applications'));
    }

    public function acceptApplication(Request $request, $id, $application_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $application = \App\Models\Application::where('id', $application_id)->where('property_id', $id)->firstOrFail();
        
        $request->validate([
            'assigned_room_number' => 'required|string|max:255'
        ]);

        $application->update(['status' => 'disetujui']);
        
        // Buat tagihan baru
        $room = \App\Models\Room::find($application->room_id);
        $amount = $room ? $room->price_monthly : 0;
        
        \App\Models\Billing::create([
            'property_id' => $property->id,
            'room_id' => $application->room_id,
            'user_id' => $application->user_id,
            'amount' => $amount,
            'status' => 'pending', // unpaid/pending
            'due_date' => now()->addDays(3),
            'duration' => $application->duration,
            'payment_method' => null,
            'payment_proof' => null,
            'verified_at' => null,
            'assigned_room_number' => $request->assigned_room_number
        ]);
        
        return redirect()->back()->with('success', 'Pengajuan sewa berhasil diterima! Tagihan awal telah dibuat.');
    }

    public function rejectApplication(Request $request, $id, $application_id)
    {
        $property = Property::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $application = \App\Models\Application::where('id', $application_id)->where('property_id', $id)->firstOrFail();
        
        $application->update(['status' => 'ditolak']);
        
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