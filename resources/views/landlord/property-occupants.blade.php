<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penghuni - {{ $property->name }}</title>
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
                
                <a href="{{ route('property.occupants', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors whitespace-nowrap">
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
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-users mr-3 text-[#38a38e]"></i> Manajemen Penghuni
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama penghuni..." class="pl-9 pr-4 py-2 bg-slate-100 border-transparent rounded-lg text-sm focus:border-[#38a38e] focus:bg-white focus:ring-0 transition-colors w-64">
                </div>
                
                <button class="bg-[#38a38e] hover:bg-teal-700 text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-md">
                    <i class="fa-solid fa-user-plus mr-2"></i> Tambah Penghuni
                </button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- TAB NAVIGASI -->
            <div class="flex border-b border-gray-200 mb-6">
                <button class="px-6 py-3 font-bold text-[#38a38e] border-b-2 border-[#38a38e]">Aktif (2)</button>
                <button class="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors">Mantan Penghuni (0)</button>
                <button class="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors">Menunggu Verifikasi (0)</button>
            </div>

            <!-- TABEL PENGHUNI -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                            <th class="py-4 px-6 font-semibold">Profil Penghuni</th>
                            <th class="py-4 px-6 font-semibold">Kamar</th>
                            <th class="py-4 px-6 font-semibold">Tanggal Masuk</th>
                            <th class="py-4 px-6 font-semibold text-center">Status Tagihan</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- Data Dummy 1 -->
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold mr-3 uppercase">BS</div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-[#1e3a5f]">Budi Santoso</span>
                                        <span class="text-xs text-gray-500">0812-3456-7890</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-700">Kamar Klasik</span>
                                <span class="block text-xs text-gray-500">Unit No. 1</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                <i class="fa-regular fa-calendar text-gray-400 mr-1"></i> 12 Jan 2024
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-xs">Lunas</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-[#38a38e] mx-2 transition-colors" title="Detail"><i class="fa-solid fa-id-card"></i></button>
                                <button class="text-gray-400 hover:text-blue-500 mx-2 transition-colors" title="Kirim Pesan"><i class="fa-brands fa-whatsapp"></i></button>
                            </td>
                        </tr>

                        <!-- Data Dummy 2 -->
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center font-bold mr-3 uppercase">SA</div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-[#1e3a5f]">Siti Aminah</span>
                                        <span class="text-xs text-gray-500">0857-9876-5432</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-700">Kamar Klasik</span>
                                <span class="block text-xs text-gray-500">Unit No. 3</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                <i class="fa-regular fa-calendar text-gray-400 mr-1"></i> 05 Mar 2024
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-yellow-100 text-yellow-700 font-bold px-3 py-1 rounded-full text-xs">Jatuh Tempo (2 Hari)</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-[#38a38e] mx-2 transition-colors" title="Detail"><i class="fa-solid fa-id-card"></i></button>
                                <button class="text-gray-400 hover:text-blue-500 mx-2 transition-colors" title="Kirim Pesan"><i class="fa-brands fa-whatsapp"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>