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
            <a href="{{ route('admin.detail') }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-bold ml-3">Kost</span>
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
    <!-- MAIN WRAPPER FULL SCREEN -->
<div class="w-full h-full flex flex-col space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
            <i class="fa-solid fa-building mr-3 text-[#38a38e]"></i>
            Data Kost
        </div>

        <!-- SEARCH -->
        <form method="GET" action="{{ route('admin.detail') }}" class="w-full md:w-80">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama kost..."
                       class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm
                              focus:outline-none focus:border-[#38a38e] bg-white shadow-sm">
            </div>
        </form>

    </div>

    <!-- TABLE CARD -->
    <div class="flex-1 bg-white border border-gray-200 shadow-sm rounded-xl overflow-hidden flex flex-col">

        <!-- HEADER -->
        <div class="px-6 py-4 bg-gray-50 border-b flex items-center justify-between">

            <h3 class="font-bold text-[#1e3a5f]">
                List Kost Terdaftar
            </h3>

            <span class="text-xs text-gray-500">
                Total: {{ count($kosts) }} kost
            </span>

        </div>

        <!-- TABLE -->
        <div class="flex-1 overflow-auto">

            <table class="w-full text-sm">

                <thead class="bg-white border-b sticky top-0 z-10 text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">Gambar</th>
                        <th class="px-6 py-4 text-left">Nama Kost</th>
                        <th class="px-6 py-4 text-left">Pemilik</th>
                        <th class="px-6 py-4 text-left">Alamat</th>
                        <th class="px-6 py-4 text-center">Denah</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($kosts as $kost)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- GAMBAR -->
                        <td class="px-6 py-4">
                            <img src="{{ asset('images/kost/kost1.jpeg' . $kost->image) }}"
                                 class="w-14 h-14 object-cover rounded-lg border"
                                 alt="kost">
                        </td>

                        <!-- NAMA -->
                        <td class="px-6 py-4">
                            <div class="font-bold text-[#1e3a5f]">
                                {{ $kost->nama_kost }}
                            </div>
                            <div class="text-xs text-gray-400">
                                ID #{{ $kost->id }}
                            </div>
                        </td>

                        <!-- PEMILIK -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $kost->owner->name ?? '-' }}
                        </td>

                        <!-- ALAMAT -->
                        <td class="px-6 py-4 text-gray-500">
                            {{ $kost->alamat }}
                        </td>

                        <!-- DENAH -->
                        <td class="px-6 py-4 text-center">

                            @if(isset($kost->map_link) && $kost->map_link)
                                <button onclick="openMap('{{ $kost->map_link }}')"
                                        class="px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-xs font-bold hover:bg-blue-100 transition">
                                    Lihat Denah
                                </button>
                            @else
                                <span class="text-gray-400 text-xs">Tidak ada</span>
                            @endif

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-3 py-1 rounded-full text-[11px]
                                         bg-green-50 text-green-600 border border-green-200 font-bold">
                                AKTIF
                            </span>
                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-4 text-center">

                            <a href="{{ route('admin.kost.show', $kost->id) }}"
                               class="inline-flex items-center gap-2 px-4 py-2
                                      bg-[#38a38e] hover:bg-teal-700 text-white
                                      rounded-lg text-xs font-bold transition shadow-sm">

                                <i class="fa-solid fa-eye"></i>
                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-16 text-gray-400">
                            Belum ada data kost
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>
    </div>
</div>

<!-- ===================== -->
<!-- MAP MODAL -->
<!-- ===================== -->

<div id="mapModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-3xl rounded-xl overflow-hidden shadow-lg">

        <div class="flex items-center justify-between px-5 py-4 border-b">
            <h3 class="font-bold text-[#1e3a5f]">Denah Lokasi Kost</h3>

            <button onclick="closeMap()" class="text-gray-500 hover:text-red-500">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <div class="p-2">
            <iframe id="mapFrame"
                    class="w-full h-[450px] rounded-lg"
                    loading="lazy">
            </iframe>
        </div>

    </div>

</div>

<script>
    function openMap(url) {
    let modal = document.getElementById('mapModal');
    let frame = document.getElementById('mapFrame');

    frame.src = url;
    modal.classList.remove('hidden');
}

function closeMap() {
    let modal = document.getElementById('mapModal');
    let frame = document.getElementById('mapFrame');

    frame.src = "";
    modal.classList.add('hidden');
}
</script>
</body>
</html>