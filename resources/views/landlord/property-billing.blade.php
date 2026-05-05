<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan & Sewa - {{ $property->name }}</title>
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

                <a href="{{ route('property.billing', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors whitespace-nowrap">
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
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-regular fa-credit-card mr-3 text-[#38a38e]"></i> Manajemen Tagihan
            </div>
            
            <button class="bg-[#38a38e] hover:bg-teal-700 text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-md">
                <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Buat Tagihan Baru
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- REKAP KEUANGAN (Financial Summary) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-green-500">
                    <p class="text-sm text-gray-500 font-semibold mb-1">Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-slate-800">Rp 4.500.000</h3>
                    <p class="text-xs text-green-600 mt-2"><i class="fa-solid fa-arrow-trend-up mr-1"></i> 3 Tagihan Lunas</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-yellow-400 relative">
                    <span class="absolute top-4 right-4 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                    </span>
                    <p class="text-sm text-gray-500 font-semibold mb-1">Menunggu Verifikasi</p>
                    <h3 class="text-2xl font-bold text-slate-800">Rp 1.500.000</h3>
                    <p class="text-xs text-yellow-600 mt-2"><i class="fa-regular fa-clock mr-1"></i> 1 Tagihan perlu diulas</p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-red-500">
                    <p class="text-sm text-gray-500 font-semibold mb-1">Tagihan Tertunggak</p>
                    <h3 class="text-2xl font-bold text-slate-800">Rp 1.650.000</h3>
                    <p class="text-xs text-red-500 mt-2"><i class="fa-solid fa-triangle-exclamation mr-1"></i> 1 Tagihan melewati tenggat</p>
                </div>
            </div>

            <!-- TAB NAVIGASI INVOICE -->
            <div class="flex border-b border-gray-200 mb-6">
                <button class="px-6 py-3 font-bold text-[#38a38e] border-b-2 border-[#38a38e]">Semua Tagihan</button>
                <button class="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors">Belum Dibayar (1)</button>
                <button class="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors relative">
                    Menunggu Verifikasi 
                    <span class="bg-yellow-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-1">1</span>
                </button>
                <button class="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors">Lunas</button>
            </div>

            <!-- TABEL TAGIHAN -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                            <th class="py-4 px-6 font-semibold">ID / Penghuni</th>
                            <th class="py-4 px-6 font-semibold">Rincian Tagihan</th>
                            <th class="py-4 px-6 font-semibold">Total Tagihan</th>
                            <th class="py-4 px-6 font-semibold text-center">Tenggat Waktu</th>
                            <th class="py-4 px-6 font-semibold text-center">Status</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        
                        <!-- Data Dummy 1: Menunggu Verifikasi -->
                        <tr class="border-b border-gray-100 hover:bg-yellow-50/30 transition-colors bg-yellow-50/10">
                            <td class="py-4 px-6">
                                <span class="text-xs font-bold text-gray-400">#INV-202605-001</span>
                                <div class="font-bold text-[#1e3a5f] mt-1">Siti Aminah</div>
                                <span class="text-xs text-gray-500">Unit No. 3</span>
                            </td>
                            <td class="py-4 px-6">
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li class="flex justify-between w-40"><span>Sewa Kamar:</span> <span class="font-medium">1.350.000</span></li>
                                    <li class="flex justify-between w-40"><span>Listrik & Air:</span> <span class="font-medium">150.000</span></li>
                                </ul>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-[#38a38e] text-base">Rp 1.500.000</span>
                            </td>
                            <td class="py-4 px-6 text-center text-gray-600">
                                05 Mei 2026
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-yellow-100 text-yellow-700 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Cek Bukti</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="bg-[#38a38e] text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-teal-700 transition-colors shadow-sm">Verifikasi</button>
                            </td>
                        </tr>

                        <!-- Data Dummy 2: Tertunggak -->
                        <tr class="border-b border-gray-100 hover:bg-red-50/30 transition-colors">
                            <td class="py-4 px-6">
                                <span class="text-xs font-bold text-gray-400">#INV-202605-002</span>
                                <div class="font-bold text-[#1e3a5f] mt-1">John Doe</div>
                                <span class="text-xs text-gray-500">Unit No. 4</span>
                            </td>
                            <td class="py-4 px-6">
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li class="flex justify-between w-40"><span>Sewa Kamar:</span> <span class="font-medium">1.500.000</span></li>
                                    <li class="flex justify-between w-40 text-red-500"><span>Denda Telat:</span> <span class="font-medium">150.000</span></li>
                                </ul>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-red-600 text-base">Rp 1.650.000</span>
                            </td>
                            <td class="py-4 px-6 text-center text-red-500 font-medium">
                                01 Mei 2026
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Tertunggak</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-green-600 border border-green-600 hover:bg-green-50 px-2 py-1.5 rounded-lg text-xs font-bold transition-colors shadow-sm" title="Ingatkan via WA">
                                    <i class="fa-brands fa-whatsapp"></i> Ingatkan
                                </button>
                            </td>
                        </tr>

                        <!-- Data Dummy 3: Lunas -->
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="text-xs font-bold text-gray-400">#INV-202604-003</span>
                                <div class="font-bold text-[#1e3a5f] mt-1">Budi Santoso</div>
                                <span class="text-xs text-gray-500">Unit No. 1</span>
                            </td>
                            <td class="py-4 px-6">
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li class="flex justify-between w-40"><span>Sewa Kamar:</span> <span class="font-medium">1.500.000</span></li>
                                    <li class="flex justify-between w-40"><span>Parkir Mobil:</span> <span class="font-medium">100.000</span></li>
                                </ul>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-600 text-base">Rp 1.600.000</span>
                            </td>
                            <td class="py-4 px-6 text-center text-gray-500">
                                28 Apr 2026
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Lunas</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-500 hover:text-[#1e3a5f] mx-2 transition-colors" title="Lihat Kwitansi"><i class="fa-solid fa-file-invoice"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>