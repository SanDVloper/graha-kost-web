<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - GRAHA</title>
    
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
            @if(auth()->user()->hasPermission('dashboard'))
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg mb-2 transition-colors {{ Request::routeIs('admin.dashboard') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3">Dashboard</span>
            </a>
            @endif
            
            
            @if(auth()->user()->hasPermission('users'))
            <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.users') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-users"></i></div>
                <span class="font-medium ml-3">Pengguna</span>
            </a>
            @endif
           
            @if(auth()->user()->hasPermission('detail'))
            <a href="{{ route('admin.detail') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.detail') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>
            @endif

            @if(auth()->user()->hasPermission('tagihan'))
            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.tagihan') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-medium ml-3">Transaksi</span>
            </a>
            @endif

            @if(auth()->user()->hasPermission('complaints'))
            <a href="{{ route('admin.complaints.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.complaints.index') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="flex items-center">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <span class="font-medium ml-3">Komplain</span>
                </div>
            </a>
            @endif

            @if(auth()->user()->hasPermission('laporan'))
            <a href="{{ route('admin.laporan') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.laporan') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-file-lines"></i></div>
                <span class="font-medium ml-3">Laporan</span>
            </a>
            @endif

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4">System</div>
            
            @if(auth()->user()->hasPermission('pengaturan'))
            <a href="{{ route('settings.global') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('settings.global') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="font-medium ml-3">Pengaturan</span>
            </a>
            @endif
        </nav>

        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center px-4 py-2">
                <div class="w-8 h-8 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold mr-3 text-xs">GP</div>
                <div>
                    <p class="font-bold text-sm text-slate-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400">Super Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0 relative z-10">
            <div class="flex items-center">
                <h2 class="text-2xl font-bold text-[#1e3a5f]">Laporan Platform GRAHA</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.laporan.export') }}" class="bg-[#1e3a5f] hover:bg-blue-900 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-file-csv"></i> Export CSV
                </a>
                <button onclick="window.print()" class="bg-white border border-gray-300 text-slate-700 hover:bg-gray-50 px-5 py-2.5 rounded-lg text-sm font-bold transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Cetak Laporan
                </button>
                <div class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 relative cursor-pointer hover:bg-gray-200 transition-colors">
                    <i class="fa-regular fa-bell"></i>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-slate-50">
            
            <!-- RINGKASAN METRIK -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Finansial -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden group hover:border-[#38a38e] transition-colors">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="text-gray-500 font-medium text-sm mb-1">Total Transaksi (GMV)</div>
                        <div class="text-3xl font-bold text-[#1e3a5f] mb-3">Rp {{ number_format($stats['gmv'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500 flex items-center">
                            <span class="text-green-500 font-bold mr-1"><i class="fa-solid fa-sack-dollar"></i></span>
                            Pendapatan Platform: Rp {{ number_format($stats['platformFee'], 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Okupansi -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden group hover:border-blue-500 transition-colors">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="text-gray-500 font-medium text-sm mb-1">Tingkat Okupansi</div>
                        <div class="text-3xl font-bold text-[#1e3a5f] mb-3">{{ $stats['occupancy']['rate'] }}%</div>
                        <div class="text-xs text-gray-500 flex items-center">
                            <span class="text-blue-500 font-bold mr-1"><i class="fa-solid fa-bed"></i></span>
                            Terisi {{ $stats['occupancy']['occupied'] }} dari {{ $stats['occupancy']['total'] }} kapasitas
                        </div>
                    </div>
                </div>

                <!-- Pengguna Baru -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden group hover:border-purple-500 transition-colors">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-purple-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="text-gray-500 font-medium text-sm mb-1">Total Pengguna</div>
                        <div class="text-3xl font-bold text-[#1e3a5f] mb-3">{{ array_sum($stats['users']) }}</div>
                        <div class="text-xs text-gray-500 flex items-center">
                            <span class="text-purple-500 font-bold mr-1"><i class="fa-solid fa-users"></i></span>
                            {{ $stats['users']['pencari'] }} Pencari, {{ $stats['users']['penghuni'] }} Penghuni
                        </div>
                    </div>
                </div>

                <!-- Komplain -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden group hover:border-orange-500 transition-colors">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-orange-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="text-gray-500 font-medium text-sm mb-1">Tiket Komplain</div>
                        <div class="text-3xl font-bold text-[#1e3a5f] mb-3">{{ array_sum($stats['complaints']) - $stats['complaints']['avg_resolution_hours'] }}</div>
                        <div class="text-xs text-gray-500 flex items-center">
                            <span class="text-orange-500 font-bold mr-1"><i class="fa-solid fa-stopwatch"></i></span>
                            Rata-rata Penyelesaian: {{ $stats['complaints']['avg_resolution_hours'] }} Jam
                        </div>
                    </div>
                </div>

            </div>

            <!-- GRAFIK CHART.JS -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Rasio Tagihan -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-[#1e3a5f] mb-4">Rasio Status Tagihan</h3>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="billingChart"></canvas>
                    </div>
                </div>

                <!-- Komposisi Pengguna -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-[#1e3a5f] mb-4">Komposisi Pengguna</h3>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- DETAIL TABEL -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-lg text-[#1e3a5f]">Ringkasan Status Komplain</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-white border-b border-gray-200 text-gray-500">
                            <tr>
                                <th class="py-4 px-6 font-semibold">Status</th>
                                <th class="py-4 px-6 font-semibold">Total Tiket</th>
                                <th class="py-4 px-6 font-semibold">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalComplaints = max(1, ($stats['complaints']['pending'] + $stats['complaints']['proses'] + $stats['complaints']['selesai'])); @endphp
                            
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 font-bold text-red-500">Pending</td>
                                <td class="py-4 px-6 font-medium">{{ $stats['complaints']['pending'] }}</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2 max-w-[200px]">
                                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ ($stats['complaints']['pending'] / $totalComplaints) * 100 }}%"></div>
                                        </div>
                                        <span>{{ round(($stats['complaints']['pending'] / $totalComplaints) * 100, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 font-bold text-yellow-500">Proses</td>
                                <td class="py-4 px-6 font-medium">{{ $stats['complaints']['proses'] }}</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2 max-w-[200px]">
                                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ ($stats['complaints']['proses'] / $totalComplaints) * 100 }}%"></div>
                                        </div>
                                        <span>{{ round(($stats['complaints']['proses'] / $totalComplaints) * 100, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 font-bold text-green-500">Selesai</td>
                                <td class="py-4 px-6 font-medium">{{ $stats['complaints']['selesai'] }}</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2 max-w-[200px]">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ ($stats['complaints']['selesai'] / $totalComplaints) * 100 }}%"></div>
                                        </div>
                                        <span>{{ round(($stats['complaints']['selesai'] / $totalComplaints) * 100, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Print CSS -->
            <style>
                @media print {
                    aside, header { display: none !important; }
                    main { overflow: visible !important; }
                    .bg-slate-50 { background: white !important; padding: 0 !important; }
                    .shadow-sm { box-shadow: none !important; border: 1px solid #ddd !important; }
                    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Data Tagihan
                    const billingCtx = document.getElementById('billingChart').getContext('2d');
                    new Chart(billingCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Lunas', 'Menunggu Verifikasi', 'Belum Bayar'],
                            datasets: [{
                                data: [{{ $stats['billings']['paid'] }}, {{ $stats['billings']['waiting'] }}, {{ $stats['billings']['pending'] }}],
                                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });

                    // Data Pengguna
                    const userCtx = document.getElementById('userChart').getContext('2d');
                    new Chart(userCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Tuan Kos', 'Pencari', 'Penghuni'],
                            datasets: [{
                                label: 'Jumlah Pengguna',
                                data: [{{ $stats['users']['tuan_kos'] }}, {{ $stats['users']['pencari'] }}, {{ $stats['users']['penghuni'] }}],
                                backgroundColor: ['#3b82f6', '#8b5cf6', '#ec4899'],
                                borderRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: { beginAtZero: true, ticks: { precision: 0 } }
                            }
                        }
                    });
                });
            </script>
        </div>
    </main>

</body>
</html>


