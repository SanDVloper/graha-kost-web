<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - {{ $property->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR KHUSUS MANAJEMEN PROPERTI -->
    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden">
            <div class="mr-3 shrink-0 w-10"><img src="{{ asset('assets/logograha.png') }}" class="w-full h-auto"></div>
            <div class="sidebar-text"><h1 class="font-bold text-xl">GRAHA</h1></div>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('landlord.dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mb-4">
                <i class="fa-solid fa-arrow-left w-6 text-cente+r"></i><span class="ml-3 sidebar-text">Dashboard Utama</span>
            </a>
            
            <div class="text-xs font-bold text-gray-400 uppercase px-4 mb-2 mt-4 truncate">{{ $property->name }}</div>
            
            <a href="{{ route('property.manage', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg">
                <i class="fa-solid fa-chart-line w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Overview</span>
            </a>
            
            <a href="{{ route('property.rooms', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-solid fa-house-user w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Kamar & Fasilitas</span>
            </a>
            
            <a href="{{ route('property.occupants', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-solid fa-users w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Penghuni (Occupant)</span>
            </a>

            <a href="{{ route('property.billing', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-regular fa-credit-card w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Tagihan & Sewa</span>
            </a>

            <a href="{{ route('property.complains', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-regular fa-envelope w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Keluhan</span>
            </a>
            <a href="{{ route('property.applications', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-solid fa-bell w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Pengajuan Masuk</span>
            </a>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4 sidebar-text whitespace-nowrap">System</div>
            
            <!-- Menu Pengaturan (Active) -->
            <a href="{{ route('property.settings', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg mt-1">
                <i class="fa-solid fa-gear w-6 text-center"></i><span class="ml-3 sidebar-text font-bold">Pengaturan Kos</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-gear mr-3 text-[#38a38e]"></i> Pengaturan Properti
            </div>
            
            <button type="submit" form="settings-form" class="bg-[#38a38e] hover:bg-teal-700 text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-md">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8 max-w-5xl mx-auto w-full">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM PENGATURAN -->
            <form id="settings-form" action="{{ route('property.settings.update', $property->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Card 1: Informasi Dasar -->
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-circle-info text-teal-600 mr-3"></i> Informasi Dasar Properti
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kos</label>
                            <input type="text" name="name" value="{{ $property->name }}" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Kos</label>
                            <select name="type" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors appearance-none">
                                <option value="putra" {{ $property->type == 'putra' ? 'selected' : '' }}>Kos Putra</option>
                                <option value="putri" {{ $property->type == 'putri' ? 'selected' : '' }}>Kos Putri</option>
                                <option value="campur" {{ $property->type == 'campur' ? 'selected' : '' }}>Kos Campur</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Properti</label>
                            <textarea name="description" rows="3" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">{{ $property->description }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Card 1.5: Aturan Kos -->
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-list-check text-teal-600 mr-3"></i> Aturan Kos
                    </h3>
                    
                    @php
                        $activeRules = $property->rules ?? [];
                    @endphp

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach([
                            'Dilarang Bawa Hewan' => 'fa-ban',
                            'Akses 24 Jam' => 'fa-key',
                            'Tamu Menginap Dikenakan Biaya' => 'fa-users-slash',
                            'Dilarang Merokok di Kamar' => 'fa-smoking-ban',
                            'Dilarang Bawa Anak' => 'fa-child-reaching',
                            'Dilarang Bawa Lawan Jenis' => 'fa-person-half-dress'
                        ] as $rule => $icon)
                        <label class="cursor-pointer border-2 {{ in_array($rule, $activeRules) ? 'border-[#38a38e] bg-teal-50' : 'border-gray-200 bg-slate-50' }} hover:border-[#38a38e] rounded-xl p-4 flex items-center gap-3 transition-all">
                            <input type="checkbox" name="rules[]" value="{{ $rule }}" class="hidden peer" {{ in_array($rule, $activeRules) ? 'checked' : '' }} onchange="this.parentElement.classList.toggle('border-[#38a38e]'); this.parentElement.classList.toggle('bg-teal-50'); this.parentElement.classList.toggle('border-gray-200'); this.parentElement.classList.toggle('bg-slate-50'); this.nextElementSibling.classList.toggle('text-[#38a38e]'); this.nextElementSibling.classList.toggle('text-gray-400'); this.nextElementSibling.nextElementSibling.classList.toggle('text-[#38a38e]'); this.nextElementSibling.nextElementSibling.classList.toggle('text-gray-700');">
                            <i class="fa-solid {{ $icon }} text-xl {{ in_array($rule, $activeRules) ? 'text-[#38a38e]' : 'text-gray-400' }}"></i>
                            <span class="text-sm font-semibold {{ in_array($rule, $activeRules) ? 'text-[#38a38e]' : 'text-gray-700' }}">{{ $rule === 'Dilarang Bawa Lawan Jenis' ? 'Bukan Muhrim Dilarang Ke Kamar' : $rule }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Card 2: Pengaturan Pembayaran -->
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-building-columns text-teal-600 mr-3"></i> Rekening Penerimaan Sewa
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Bank / E-Wallet</label>
                            <select class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors appearance-none">
                                <option value="">Pilih Bank...</option>
                                <option value="bca" selected>BCA</option>
                                <option value="bni">BNI</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bri">BRI</option>
                                <option value="gopay">GoPay</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Rekening</label>
                            <input type="text" placeholder="Contoh: 1234567890" value="8921002911" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Atas Nama (Pemilik)</label>
                            <input type="text" placeholder="Nama sesuai buku tabungan" value="{{ auth()->user()->name }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                        </div>
                    </div>
                </div>
            </form>

            <!-- Card 3: Zona Berbahaya (Danger Zone) -->
            <div class="bg-white rounded-xl border border-red-200 p-8 shadow-sm relative overflow-hidden mt-8">
                    <div class="absolute top-0 left-0 w-1 h-full bg-red-500"></div>
                    <h3 class="text-lg font-bold text-red-600 mb-2 flex items-center">
                        <i class="fa-solid fa-triangle-exclamation mr-3"></i> Danger Zone
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">Tindakan di area ini bersifat permanen dan berdampak langsung pada operasional properti Tuanku.</p>
                    
                    <div class="flex items-center justify-between py-4 border-b border-gray-100">
                        <div>
                            @if($property->is_active)
                                <h4 class="font-bold text-slate-800">Tutup Kos Sementara</h4>
                                <p class="text-xs text-gray-500 mt-1">Kos tidak akan muncul di pencarian, namun data penghuni tetap aman.</p>
                            @else
                                <h4 class="font-bold text-slate-800">Buka Kembali Kos</h4>
                                <p class="text-xs text-gray-500 mt-1">Kos akan kembali muncul di pencarian untuk calon penghuni baru.</p>
                            @endif
                        </div>
                        <form action="{{ route('property.deactivate', $property->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 font-bold text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                {{ $property->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <div>
                            <h4 class="font-bold text-red-600">Hapus Properti Permanen</h4>
                            <p class="text-xs text-gray-500 mt-1">Menghapus seluruh data properti, kamar, tagihan, dan histori penghuni.</p>
                        </div>
                        <form action="{{ route('property.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus properti ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white font-bold text-sm rounded-lg transition-colors border border-red-200 hover:border-red-500">Hapus Properti</button>
                        </form>
                    </div>
                </div>

        </div>
    </main>

</body>
</html>
