<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tagihan - Admin GRAHA</title>
    
    <!-- MENGGUNAKAN STANDAR GRAHA: Vite, FontAwesome, dan Font Inter -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

            <a href="{{ route('admin.kost.detail') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>

            <!-- Menu Transaksi/Tagihan (Active) -->
            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-bold ml-3">Transaksi</span>
            </a>

            <a href="#" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
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
                <i class="fa-solid fa-file-invoice-dollar mr-3 text-[#38a38e]"></i> Manajemen Transaksi & Tagihan
            </div>

            <div class="flex items-center gap-6">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#38a38e] font-bold text-sm transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- SCROLLABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-l-4 border-l-blue-500 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-blue-50 opacity-50 group-hover:scale-110 transition-transform"><i class="fa-solid fa-money-bill-wave text-6xl"></i></div>
                    <p class="text-sm text-gray-500 font-semibold mb-1 relative z-10">Total Tagihan (Sistem)</p>
                    <h3 class="text-2xl font-bold text-[#1e3a5f] relative z-10">Rp 12.000.000</h3>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-l-4 border-l-green-500 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-green-50 opacity-50 group-hover:scale-110 transition-transform"><i class="fa-solid fa-check-double text-6xl"></i></div>
                    <p class="text-sm text-gray-500 font-semibold mb-1 relative z-10">Sudah Dibayar</p>
                    <h3 class="text-2xl font-bold text-green-600 relative z-10">Rp 8.000.000</h3>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-l-4 border-l-red-500 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-red-50 opacity-50 group-hover:scale-110 transition-transform"><i class="fa-solid fa-clock-rotate-left text-6xl"></i></div>
                    <p class="text-sm text-gray-500 font-semibold mb-1 relative z-10">Belum Dibayar</p>
                    <h3 class="text-2xl font-bold text-red-500 relative z-10">Rp 4.000.000</h3>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-l-4 border-l-yellow-500 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-yellow-50 opacity-50 group-hover:scale-110 transition-transform"><i class="fa-solid fa-triangle-exclamation text-6xl"></i></div>
                    <p class="text-sm text-gray-500 font-semibold mb-1 relative z-10">Jatuh Tempo</p>
                    <h3 class="text-2xl font-bold text-yellow-600 relative z-10">5 Tagihan</h3>
                </div>

            </div>

            <!-- FILTER BAR -->
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm mb-8 flex flex-col md:flex-row gap-4 items-center justify-between">
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Cari nama penghuni..." class="pl-9 pr-4 py-2.5 bg-slate-50 border border-gray-200 rounded-lg text-sm focus:border-[#38a38e] focus:bg-white focus:outline-none transition-colors w-full md:w-64">
                    </div>

                    <select class="px-4 py-2.5 bg-slate-50 border border-gray-200 rounded-lg text-sm text-slate-700 focus:border-[#38a38e] focus:bg-white focus:outline-none transition-colors appearance-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="belum">Belum Bayar</option>
                        <option value="jatuh_tempo">Jatuh Tempo</option>
                    </select>

                    <input type="month" class="px-4 py-2.5 bg-slate-50 border border-gray-200 rounded-lg text-sm text-slate-700 focus:border-[#38a38e] focus:bg-white focus:outline-none transition-colors">
                </div>

                <button id="btnFilter" class="bg-white border border-gray-300 text-slate-700 hover:bg-gray-50 px-5 py-2.5 rounded-lg text-sm font-bold transition-colors w-full md:w-auto flex items-center justify-center gap-2">
                    <i class="fa-solid fa-filter"></i> Terapkan Filter
                </button>

            </div>

            <!-- TABLE AREA -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-lg text-[#1e3a5f]">Daftar Tagihan Keseluruhan</h3>
                    <button class="bg-[#38a38e] hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors shadow-sm">
                        <i class="fa-solid fa-plus mr-1"></i> Buat Tagihan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-white border-b border-gray-200 text-gray-500">
                            <tr>
                                <th class="py-4 px-6 font-semibold">Nama Penghuni</th>
                                <th class="py-4 px-6 font-semibold">Kamar / Kost</th>
                                <th class="py-4 px-6 font-semibold">Periode Bulan</th>
                                <th class="py-4 px-6 font-semibold">Jumlah Tagihan</th>
                                <th class="py-4 px-6 font-semibold text-center">Status</th>
                                <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            <!-- Data Lunas -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 font-bold text-[#1e3a5f]">Budi Santoso</td>
                                <td class="py-4 px-6">
                                    <span class="text-slate-700 font-medium block">Kamar A1</span>
                                    <span class="text-[10px] text-gray-400">Kost Putra Sejahtera</span>
                                </td>
                                <td class="py-4 px-6 text-gray-600"><i class="fa-regular fa-calendar mr-1 text-gray-400"></i> Mei 2026</td>
                                <td class="py-4 px-6 font-bold text-slate-700">Rp 1.000.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Lunas</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('admin.pembayaran') }}" class="text-gray-400 hover:text-[#38a38e] transition-colors" title="Proses Pembayaran"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>

                            <!-- Data Belum Bayar -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 font-bold text-[#1e3a5f]">Andi Pratama</td>
                                <td class="py-4 px-6">
                                    <span class="text-slate-700 font-medium block">Kamar A2</span>
                                    <span class="text-[10px] text-gray-400">Kost Putra Sejahtera</span>
                                </td>
                                <td class="py-4 px-6 text-gray-600"><i class="fa-regular fa-calendar mr-1 text-gray-400"></i> Mei 2026</td>
                                <td class="py-4 px-6 font-bold text-slate-700">Rp 1.000.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-red-50 text-red-500 border border-red-200 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Belum Bayar</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button class="text-gray-400 hover:text-[#38a38e] transition-colors" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>

                            <!-- Data Jatuh Tempo -->
                            <tr class="border-b border-gray-100 hover:bg-yellow-50/20 transition-colors">
                                <td class="py-4 px-6 font-bold text-[#1e3a5f]">Sari Wahyuni</td>
                                <td class="py-4 px-6">
                                    <span class="text-slate-700 font-medium block">Kamar A3</span>
                                    <span class="text-[10px] text-gray-400">Kost Putri Indah</span>
                                </td>
                                <td class="py-4 px-6 text-gray-600"><i class="fa-regular fa-calendar mr-1 text-gray-400"></i> Mei 2026</td>
                                <td class="py-4 px-6 font-bold text-slate-700">Rp 1.000.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-yellow-100 text-yellow-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Jatuh Tempo</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button class="text-gray-400 hover:text-[#38a38e] transition-colors" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

<script>
    // Contoh interaksi jQuery (asli dari teman Tuanku dengan penyesuaian ID)
    $(document).ready(function(){
        $("#btnFilter").click(function(){
            alert("Sistem Filter sedang diproses... (Dummy)");
        });
    });
</script>

</body>
</html>