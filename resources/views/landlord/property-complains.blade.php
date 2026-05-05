<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keluhan - {{ $property->name }}</title>
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

                <a href="{{ route('property.complains', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors whitespace-nowrap">
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

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-regular fa-comments mr-3 text-[#38a38e]"></i> Manajemen Keluhan
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari keluhan atau pelapor..." class="pl-9 pr-4 py-2 bg-slate-100 border-transparent rounded-lg text-sm focus:border-[#38a38e] focus:bg-white focus:ring-0 transition-colors w-64">
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- REKAP KELUHAN -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Total Tiket</span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center"><i class="fa-solid fa-ticket"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">3</h3>
                </div>
                
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-b-4 border-b-red-500">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Menunggu Respon</span>
                        <div class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center"><i class="fa-solid fa-circle-exclamation"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">1</h3>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-b-4 border-b-blue-500">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Sedang Diproses</span>
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">1</h3>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-b-4 border-b-green-500">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Terselesaikan</span>
                        <div class="w-8 h-8 rounded-full bg-green-50 text-green-500 flex items-center justify-center"><i class="fa-solid fa-check-double"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">1</h3>
                </div>
            </div>

            <!-- TABEL KELUHAN -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                            <th class="py-4 px-6 font-semibold w-1/4">Pelapor & Waktu</th>
                            <th class="py-4 px-6 font-semibold w-2/5">Detail Keluhan</th>
                            <th class="py-4 px-6 font-semibold text-center w-1/6">Prioritas</th>
                            <th class="py-4 px-6 font-semibold text-center w-1/6">Status</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        <!-- Data Dummy 1: Menunggu -->
                        <tr class="border-b border-gray-100 hover:bg-red-50/20 transition-colors">
                            <td class="py-4 px-6 align-top">
                                <div class="font-bold text-[#1e3a5f]">Siti Aminah</div>
                                <span class="text-xs text-gray-500 block mb-1">Unit No. 3</span>
                                <span class="text-[10px] text-gray-400"><i class="fa-regular fa-clock"></i> Hari ini, 08:30 WITA</span>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 mb-1">Fasilitas Kamar</span>
                                <h4 class="font-bold text-slate-800 mb-1">AC Kamar Bocor</h4>
                                <p class="text-xs text-gray-500 line-clamp-2">Permisi Pak, AC di kamar saya meneteskan air lumayan deras sejak semalam. Mohon bantuannya untuk diperbaiki karena membasahi lantai.</p>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <span class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider"><i class="fa-solid fa-angles-up mr-1"></i> Tinggi</span>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <span class="bg-orange-100 text-orange-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Menunggu</span>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <button class="bg-[#38a38e] text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-teal-700 transition-colors shadow-sm w-full mb-1">Respon</button>
                            </td>
                        </tr>

                        <!-- Data Dummy 2: Diproses -->
                        <tr class="border-b border-gray-100 hover:bg-blue-50/20 transition-colors">
                            <td class="py-4 px-6 align-top">
                                <div class="font-bold text-[#1e3a5f]">Budi Santoso</div>
                                <span class="text-xs text-gray-500 block mb-1">Unit No. 1</span>
                                <span class="text-[10px] text-gray-400"><i class="fa-regular fa-clock"></i> Kemarin, 14:15 WITA</span>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 mb-1">Fasilitas Umum</span>
                                <h4 class="font-bold text-slate-800 mb-1">Lampu Lorong Lantai 2 Mati</h4>
                                <p class="text-xs text-gray-500 line-clamp-2">Lampu di ujung lorong lantai 2 putus sepertinya, jadi kalau malam cukup gelap saat mau ke dapur bersama.</p>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <span class="bg-yellow-100 text-yellow-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Sedang</span>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <span class="bg-blue-100 text-blue-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Diproses</span>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <button class="text-[#38a38e] border border-[#38a38e] hover:bg-teal-50 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors w-full">Update</button>
                            </td>
                        </tr>

                        <!-- Data Dummy 3: Selesai -->
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors opacity-70">
                            <td class="py-4 px-6 align-top">
                                <div class="font-bold text-[#1e3a5f]">John Doe</div>
                                <span class="text-xs text-gray-500 block mb-1">Unit No. 4</span>
                                <span class="text-[10px] text-gray-400"><i class="fa-regular fa-clock"></i> 28 Apr 2026</span>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 mb-1">Keamanan / Kenyamanan</span>
                                <h4 class="font-bold text-slate-800 mb-1">Gerbang Susah Dikunci</h4>
                                <p class="text-xs text-gray-500 line-clamp-2">Gembok gerbang depan karatan jadi susah sekali untuk dikunci kalau pulang malam.</p>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <span class="bg-blue-100 text-blue-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider"><i class="fa-solid fa-angle-down mr-1"></i> Rendah</span>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Selesai</span>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <button class="text-gray-500 hover:text-[#1e3a5f] transition-colors" title="Lihat Detail Tiket"><i class="fa-solid fa-eye"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>