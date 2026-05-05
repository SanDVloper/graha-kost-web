<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamar & Fasilitas - {{ $property->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden">
            <div class="mr-3 shrink-0 w-10"><img src="{{ asset('assets/logograha.png') }}" class="w-full h-auto"></div>
            <div class="sidebar-text"><h1 class="font-bold text-xl">GRAHA</h1></div>
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
                <a href="{{ route('property.manage', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-line"></i></div>
                    <span class="font-bold ml-3 sidebar-text">Overview</span>
                </a>

                <a href="{{ route('property.rooms', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors whitespace-nowrap">
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

                <a href="{{ route('property.complains', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg">
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
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-bed mr-3 text-[#38a38e]"></i> Kamar & Fasilitas
            </div>
            <button class="bg-[#38a38e] hover:bg-teal-700 text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-md">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Tipe Kamar
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Daftar Unit Kamar</h2>
                <p class="text-gray-500">Kelola status ketersediaan dan penghuni di setiap unit.</p>
            </div>

            @foreach($property->rooms as $roomType)
                <div class="mb-10">
                    <div class="flex items-center gap-4 mb-4">
                        <h3 class="text-lg font-bold text-[#1e3a5f] bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                            Tipe: {{ $roomType->name }} 
                            <span class="ml-2 text-xs font-normal text-gray-400">({{ $roomType->quantity }} Unit)</span>
                        </h3>
                        <div class="h-px flex-1 bg-gray-200"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @for($i = 1; $i <= $roomType->quantity; $i++)
                            @php
                                // Simulasi: Anggap saja unit nomor 1 & 3 sudah ada penghuninya
                                $isOccupied = ($i == 1 || $i == 3);
                                $occupantName = $isOccupied ? ($i == 1 ? "Budi Santoso" : "Siti Aminah") : null;
                            @endphp

                            <div class="bg-white rounded-xl border-2 {{ $isOccupied ? 'border-teal-100 bg-white' : 'border-dashed border-gray-200 bg-gray-50/30' }} p-5 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                                @if($isOccupied)
                                    <div class="absolute top-0 left-0 w-1 h-full bg-[#38a38e]"></div>
                                @endif
                                
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 rounded-lg {{ $isOccupied ? 'bg-teal-50 text-[#38a38e]' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center font-bold text-lg">
                                        {{ $i }}
                                    </div>
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $isOccupied ? 'bg-teal-50 text-[#38a38e] border border-teal-100' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                                        {{ $isOccupied ? 'Terisi' : 'Tersedia' }}
                                    </span>
                                </div>

                                <div class="space-y-1">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Penghuni</p>
                                    @if($isOccupied)
                                        <p class="font-bold text-[#1e3a5f] truncate">{{ $occupantName }}</p>
                                        <p class="text-[11px] text-gray-500"><i class="fa-regular fa-calendar-check mr-1"></i> Sejak 12 Jan 2024</p>
                                    @else
                                        <p class="text-sm italic text-gray-400">Kosong</p>
                                        <button class="mt-2 text-[#38a38e] text-xs font-bold hover:underline">
                                            <i class="fa-solid fa-user-plus mr-1"></i> Tambahkan Penghuni
                                        </button>
                                    @endif
                                </div>

                                <div class="mt-5 pt-4 border-t border-gray-100 flex justify-between items-center">
                                    <button class="text-gray-400 hover:text-[#38a38e] text-xs font-bold transition-colors">
                                        <i class="fa-solid fa-eye mr-1"></i> Detail
                                    </button>
                                    <button class="text-gray-400 hover:text-red-500 text-xs font-bold transition-colors">
                                        <i class="fa-solid fa-gear"></i>
                                    </button>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </main>

</body>
</html>