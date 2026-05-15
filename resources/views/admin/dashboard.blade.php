<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GRAHA</title>
    
    <!-- MENGGUNAKAN STANDAR GRAHA: Vite, FontAwesome, dan Font Inter -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden">
            <div class="mr-3 shrink-0 w-10"><img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="w-full h-auto"></div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl text-[#1e3a5f]">GRAHA</h1>
                <p class="text-[0.6rem] text-[#38a38e] font-semibold uppercase tracking-wider">Super Admin</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg mb-2">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-bold ml-3">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-user-check"></i></div>
                <span class="font-medium ml-3">Verifikasi Akun</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-users"></i></div>
                <span class="font-medium ml-3">Pengguna</span>
            </a>

            <a href="{{ route('admin.detail') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>

            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-medium ml-3">Transaksi</span>
            </a>

            <a href="{{ route('admin.complaints.index') }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
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
            <h2 class="text-xl font-bold text-[#1e3a5f]">Admin Dashboard</h2>

            <div class="flex items-center gap-6">
                <!-- Search -->
                <div class="relative hidden md:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Cari sesuatu..." class="pl-9 pr-4 py-2 bg-slate-100 border-transparent rounded-lg text-sm focus:border-[#38a38e] focus:bg-white focus:ring-0 transition-colors w-64">
                </div>

                <button class="text-gray-400 hover:text-[#38a38e] transition-colors relative">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                </button>

                <form method="POST" action="/logout" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-bold px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- SCROLLABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- STAT CARD (Dari teman Tuanku) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 border-l-4 border-l-blue-500">
                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center text-xl"><i class="fa-solid fa-users"></i></div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-0.5">Total Pengguna</p>
                        <h3 class="text-2xl font-bold text-slate-800">1.245</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 border-l-4 border-l-[#38a38e]">
                    <div class="w-12 h-12 rounded-full bg-teal-50 text-[#38a38e] flex items-center justify-center text-xl"><i class="fa-solid fa-building"></i></div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-0.5">Total Kost</p>
                        <h3 class="text-2xl font-bold text-slate-800">1.245</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 border-l-4 border-l-green-500">
                    <div class="w-12 h-12 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-xl"><i class="fa-solid fa-money-bill-wave"></i></div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-0.5">Total Transaksi</p>
                        <h3 class="text-2xl font-bold text-slate-800">Rp 12 jt</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 border-l-4 border-l-red-500">
                    <div class="w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center text-xl"><i class="fa-solid fa-bullhorn"></i></div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold mb-0.5">Komplain Aktif</p>
                        <h3 class="text-2xl font-bold text-red-600">25</h3>
                    </div>
                </div>
            </div>

            <!-- CONTENT GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <!-- CHART -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="mb-6 font-bold text-lg text-[#1e3a5f]">Statistik Sistem</h3>    
                <div class="relative h-80 w-full">
                    <canvas id="chart"></canvas>
                </div>
    
            </div>

                <!-- NOTIF -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3 class="mb-6 font-bold text-lg text-[#1e3a5f]">Notifikasi</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-user-plus text-xs"></i></div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700">User baru mendaftar</p>
                                <p class="text-xs text-gray-400">2 menit yang lalu</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-triangle-exclamation text-xs"></i></div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700">5 komplain baru</p>
                                <p class="text-xs text-gray-400">1 jam yang lalu</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center shrink-0 mt-0.5"><i class="fa-regular fa-clock text-xs"></i></div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700">2 pembayaran pending</p>
                                <p class="text-xs text-gray-400">3 jam yang lalu</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- AKTIVITAS -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="mb-6 font-bold text-lg text-[#1e3a5f]">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-circle-check text-green-500"></i> Akun "Budi" baru mendaftar
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-circle-check text-green-500"></i> Pembayaran INV-001 berhasil divalidasi
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-circle-check text-green-500"></i> Komplain K-099 ditambahkan oleh sistem
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <i class="fa-solid fa-circle-check text-green-500"></i> Akun "Kos Graha" diverifikasi oleh Admin
                    </div>
                </div>
            </div>

        </div>
    </main>

<!-- SCRIPT CHART JS (Logika Asli Milik Teman Tuanku) -->
<script>
    const ctx = document.getElementById('chart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['20 Apr', '25 Apr', '30 Apr', '5 Mei', '10 Mei'],
            datasets: [
                {
                    label: 'Pengguna',
                    data: [20, 40, 60, 50, 80],
                    borderColor: '#38a38e', // Disesuaikan dengan warna GRAHA
                    backgroundColor: 'rgba(56, 163, 142, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Transaksi',
                    data: [10, 30, 50, 40, 70],
                    borderColor: '#1e3a5f', // Disesuaikan dengan warna GRAHA
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
</script>

</body>
</html>