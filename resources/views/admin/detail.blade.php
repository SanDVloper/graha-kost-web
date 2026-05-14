<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kost - Admin GRAHA</title>
    
    <!-- MENGGUNAKAN STANDAR GRAHA: Vite, FontAwesome, dan Font Inter -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR GRAHA STYLE -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20 shrink-0">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden">
            <div class="mr-3 shrink-0 w-10"><img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="w-full h-auto"></div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl text-[#1e3a5f]">GRAHA</h1>
                <p class="text-[0.6rem] text-[#38a38e] font-semibold uppercase tracking-wider">Super Admin</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg mb-2 transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-user-check"></i></div>
                <span class="font-medium ml-3">Verifikasi Akun</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-users"></i></div>
                <span class="font-medium ml-3">Pengguna</span>
            </a>

            <!-- Menu Kost (Active) -->
            <a href="{{ route('admin.kost.detail') }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-bold ml-3">Kost</span>
            </a>

            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-medium ml-3">Transaksi</span>
            </a>

<<<<<<< HEAD
            <a href="{{ route('admin.complaints.index') }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
=======
            <a href="#" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
>>>>>>> 49c3cf517adcd415cecc4e0f02dd1bb68627fd28
                <div class="flex items-center">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <span class="font-medium ml-3">Komplain</span>
                </div>
                <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">5</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-file-lines"></i></div>
                <span class="font-medium ml-3">Laporan</span>
            </a>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4">System</div>
            
            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="font-medium ml-3">Pengaturan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center px-4 py-2">
                <div class="w-8 h-8 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold mr-3 text-xs">GP</div>
                <div>
                    <p class="font-bold text-sm text-slate-800">Guntur Putra</p>
                    <p class="text-xs text-gray-400">Super Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">

        <!-- TOPBAR -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-building mr-3 text-[#38a38e]"></i> Detail Kost
            </div>

            <div class="flex items-center gap-6">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#38a38e] font-bold text-sm transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </header>

        <!-- SCROLLABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- INFO UTAMA CARD -->
            <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- FOTO -->
                    <div class="col-span-1">
                        <div class="aspect-[4/3] rounded-xl overflow-hidden border border-gray-200 shadow-sm relative">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Kost Profile" class="w-full h-full object-cover">
                            <div class="absolute top-3 left-3">
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-xs shadow-sm flex items-center gap-1.5">
                                    <i class="fa-solid fa-circle text-[8px]"></i> Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- DETAIL -->
                    <div class="col-span-1 md:col-span-2 flex flex-col justify-center">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-2xl font-bold text-[#1e3a5f]">Kost Putra Sejahtera</h3>
                            <button class="text-gray-400 hover:text-red-500 transition-colors" title="Banned/Nonaktifkan Kost"><i class="fa-solid fa-ban"></i></button>
                        </div>
                        
                        <p class="text-gray-500 text-sm mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-red-500"></i> Jl. Mawar No. 10, Denpasar
                        </p>

                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 p-5 bg-slate-50 rounded-xl border border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wider">Harga Mulai</p>
                                <p class="font-bold text-[#1e3a5f]">Rp 1.000.000<span class="text-xs text-gray-500 font-normal">/bln</span></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wider">Total Kamar</p>
                                <p class="font-bold text-slate-700">20 Unit</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wider">Kamar Terisi</p>
                                <p class="font-bold text-[#38a38e]">15 Unit</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wider">Kamar Kosong</p>
                                <p class="font-bold text-red-500">5 Unit</p>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">BP</div>
                            <div class="text-sm">
                                <p class="font-bold text-slate-700">Bapak Pemilik (Owner)</p>
                                <p class="text-xs text-gray-500">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- FASILITAS CARD -->
            <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm mb-8">
                <h3 class="font-bold text-lg text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                    <i class="fa-solid fa-list-check text-teal-600 mr-3"></i> Fasilitas Umum Kost
                </h3>

                <div class="flex flex-wrap gap-3 text-sm">
                    <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 border border-gray-200">
                        <i class="fa-solid fa-wifi text-gray-400"></i> WiFi
                    </span>
                    <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 border border-gray-200">
                        <i class="fa-solid fa-wind text-gray-400"></i> AC
                    </span>
                    <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 border border-gray-200">
                        <i class="fa-solid fa-shower text-gray-400"></i> Kamar Mandi Dalam
                    </span>
                    <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 border border-gray-200">
                        <i class="fa-solid fa-motorcycle text-gray-400"></i> Parkir Motor
                    </span>
                    <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 border border-gray-200">
                        <i class="fa-solid fa-kitchen-set text-gray-400"></i> Dapur Bersama
                    </span>
                </div>
            </div>

            <!-- LIST KAMAR TABLE -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-lg text-[#1e3a5f]">Daftar Kamar</h3>
                    <button class="bg-[#38a38e] hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors shadow-sm">
                        <i class="fa-solid fa-plus mr-1"></i> Tambah Kamar
                    </button>
                </div>

                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-500">
                        <tr>
                            <th class="py-4 px-6 font-semibold w-16 text-center">No</th>
                            <th class="py-4 px-6 font-semibold">Nama Kamar / Tipe</th>
                            <th class="py-4 px-6 font-semibold text-center">Status</th>
                            <th class="py-4 px-6 font-semibold">Penghuni Saat Ini</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 text-center text-gray-500 font-medium">1</td>
                            <td class="py-4 px-6 font-bold text-[#1e3a5f]">Kamar A1 <span class="block text-xs font-normal text-gray-500">Tipe Standar</span></td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-teal-100 text-[#38a38e] font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Terisi</span>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-700">Budi Santoso</td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-[#38a38e] transition-colors"><i class="fa-solid fa-eye"></i></button>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 text-center text-gray-500 font-medium">2</td>
                            <td class="py-4 px-6 font-bold text-[#1e3a5f]">Kamar A2 <span class="block text-xs font-normal text-gray-500">Tipe Standar</span></td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Kosong</span>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-400 italic">-</td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-[#38a38e] transition-colors"><i class="fa-solid fa-eye"></i></button>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 text-center text-gray-500 font-medium">3</td>
                            <td class="py-4 px-6 font-bold text-[#1e3a5f]">Kamar A3 <span class="block text-xs font-normal text-gray-500">Tipe VIP</span></td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-teal-100 text-[#38a38e] font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Terisi</span>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-700">Andi Pratama</td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-[#38a38e] transition-colors"><i class="fa-solid fa-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>