<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola {{ $property->name }} - GRAHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR KHUSUS MANAJEMEN PROPERTI -->
    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        <button id="toggle-sidebar" class="absolute -right-3.5 top-1/2 -translate-y-1/2 bg-white border border-gray-200 rounded-full w-7 h-7 flex items-center justify-center text-gray-500 hover:text-teal-600 hover:bg-teal-50 shadow-md transition-transform duration-300 z-50">
            <i class="fa-solid fa-chevron-left text-xs"></i>
        </button>

        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden whitespace-nowrap">
            <div class="mr-3 shrink-0 flex items-center justify-center w-10">
                <img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="w-full h-auto drop-shadow-sm">
            </div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl text-slate-800 tracking-wide">GRAHA</h1>
                <p class="text-[0.6rem] text-teal-600 font-semibold uppercase tracking-wider">Property Manager</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto overflow-x-hidden">
            <!-- Tombol Kembali ke Dashboard Global -->
            <a href="{{ url('/') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#1e3a5f] rounded-lg mb-6 whitespace-nowrap border border-transparent hover:border-gray-200 transition-all">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-arrow-left"></i></div>
                <span class="font-bold ml-3 sidebar-text">Global Dashboard</span>
            </a>

            <div id="manage-group" class="space-y-1">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 mt-4 px-4 sidebar-text whitespace-nowrap truncate" title="{{ $property->name }}">
                    {{ $property->name }}
                </div>
                
                <!-- Menu Overview (Active) -->
                <a href="{{ route('property.manage', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors whitespace-nowrap">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-line"></i></div>
                    <span class="font-bold ml-3 sidebar-text">Overview</span>
                </a>

                <a href="{{ route('property.rooms', $property->id) }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg transition-colors whitespace-nowrap mt-1">
                    <div class="flex items-center">
                        <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-house-user"></i></div>
                        <span class="ml-3 sidebar-text">Kamar & Fasilitas</span>
                    </div>
                </a>
                
                <a href="{{ route('property.occupants', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg">
                    <i class="fa-solid fa-users w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Penghuni</span>
                </a>

                <a href="{{ route('property.billing', $property->id) }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg transition-colors whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-6 shrink-0 flex justify-center"><i class="fa-regular fa-credit-card"></i></div>
                        <span class="ml-3 sidebar-text">Tagihan & Sewa</span>
                    </div>
                </a>

                <a href="{{ route('property.complains', $property->id) }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg transition-colors whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-6 shrink-0 flex justify-center"><i class="fa-regular fa-envelope"></i></div>
                        <span class="ml-3 sidebar-text">Keluhan</span>
                        <!-- Contoh Badge Notifikasi -->
                        <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-2 sidebar-text">2</span>
                    </div>
                </a>
            </div>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4 sidebar-text whitespace-nowrap">System</div>
            
            <a href="{{ route('property.settings', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg transition-colors whitespace-nowrap">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="ml-3 sidebar-text">Pengaturan Kos</span>
            </a>
        </nav>

        <!-- TOMBOL LOGOUT (STICKY BOTTOM) -->
        <div class="p-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors whitespace-nowrap font-bold">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <span class="ml-3 sidebar-text">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
        
        <!-- HEADER -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center text-[#1e3a5f] font-bold text-xl">
                <i class="fa-solid fa-building mr-3 text-[#38a38e]"></i>
                {{ $property->name }}
            </div>

            <div class="flex items-center space-x-6">
                <button class="text-gray-400 hover:text-teal-600 transition-colors relative">
                    <i class="fa-regular fa-bell text-xl"></i>
                </button>
                
                <!-- PROFIL USER -->
                <div class="flex items-center cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-teal-200 text-teal-700 flex items-center justify-center font-bold mr-3 uppercase drop-shadow-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="flex flex-col mr-2">
                        <span class="font-bold text-slate-800 text-sm">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-teal-600 font-medium">Pemilik Kos</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- DASHBOARD KONTEN PROPERTI -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800 mb-1">Overview Properti</h2>
                <p class="text-gray-500 text-sm">Ringkasan statistik operasional {{ $property->name }} saat ini.</p>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Kamar -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-1">Total Unit Kamar</p>
                        <h3 class="text-2xl font-bold text-[#1e3a5f]">{{ $property->rooms->sum('quantity') }}</h3>
                    </div>
                </div>
                
                <!-- Kamar Terisi (Data Dummy Sementara) -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-teal-50 text-[#38a38e] flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-bed"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-1">Kamar Terisi</p>
                        <h3 class="text-2xl font-bold text-[#1e3a5f]">0</h3>
                    </div>
                </div>

                <!-- Kamar Kosong (Data Dummy Sementara) -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-1">Kamar Tersedia</p>
                        <h3 class="text-2xl font-bold text-[#1e3a5f]">{{ $property->rooms->sum('quantity') }}</h3>
                    </div>
                </div>

                <!-- Estimasi Pendapatan -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-1">Pendapatan Bulan Ini</p>
                        <h3 class="text-xl font-bold text-[#1e3a5f]">Rp 0</h3>
                    </div>
                </div>
            </div>

            <!-- Tipe Kamar List -->
            <h3 class="text-xl font-bold text-slate-800 mb-4 border-b border-gray-200 pb-2">Daftar Tipe Kamar</h3>
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                            <th class="py-4 px-6 font-semibold">Tipe Kamar</th>
                            <th class="py-4 px-6 font-semibold text-center">Ukuran</th>
                            <th class="py-4 px-6 font-semibold text-center">Jumlah Unit</th>
                            <th class="py-4 px-6 font-semibold">Harga Bulanan</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($property->rooms as $room)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-bold text-[#1e3a5f]">{{ $room->name }}</td>
                            <td class="py-4 px-6 text-gray-600 text-center">{{ $room->size }} m²</td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-50 text-blue-600 font-bold px-3 py-1 rounded-full">{{ $room->quantity }}</span>
                            </td>
                            <td class="py-4 px-6 text-[#38a38e] font-bold">
                                Rp {{ $room->price_monthly ? number_format($room->price_monthly, 0, ',', '.') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-[#38a38e] mx-1 transition-colors"><i class="fa-solid fa-pen"></i></button>
                                <button class="text-gray-400 hover:text-red-500 mx-1 transition-colors"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500 italic">Belum ada tipe kamar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <script type="module">
        $(document).ready(function() {
            let isSidebarOpen = true;

            $('#toggle-sidebar').click(function() {
                isSidebarOpen = !isSidebarOpen;

                if (isSidebarOpen) {
                    $('#sidebar').removeClass('w-20').addClass('w-64');
                    setTimeout(() => {
                        $('.sidebar-text').fadeIn(200); 
                    }, 150); 
                    $(this).css('transform', 'translateY(-50%) rotate(0deg)');
                } else {
                    $('.sidebar-text').hide();
                    $('#sidebar').removeClass('w-64').addClass('w-20');
                    $(this).css('transform', 'translateY(-50%) rotate(180deg)');
                }
            });
        });
    </script>
</body>
</html>