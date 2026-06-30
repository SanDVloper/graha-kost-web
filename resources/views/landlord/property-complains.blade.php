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
            <a href="{{ route('landlord.dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#1e3a5f] rounded-lg mb-6 whitespace-nowrap border border-transparent hover:border-gray-200 transition-all">
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
                        @php $pendingComplains = $property->complains()->whereIn('status', ['menunggu', 'diproses'])->count(); @endphp
                        @if($pendingComplains > 0)
                            <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-2 sidebar-text">{{ $pendingComplains }}</span>
                        @endif
                    </div>
                </a>
                <a href="{{ route('property.applications', $property->id) }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg transition-colors whitespace-nowrap mt-1">
                    <div class="flex items-center">
                        <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-bell"></i></div>
                        <span class="ml-3 sidebar-text">Pengajuan Masuk</span>
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
                
                <button onclick="document.getElementById('broadcastModal').classList.remove('hidden')" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-bold text-sm transition-all shadow-md">
                    <i class="fa-solid fa-bullhorn mr-1"></i> Buat Pengumuman
                </button>
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
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">{{ $countTotal ?? 0 }}</h3>
                </div>
                
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-b-4 border-b-red-500">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Menunggu Respon</span>
                        <div class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center"><i class="fa-solid fa-circle-exclamation"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">{{ $countMenunggu ?? 0 }}</h3>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-b-4 border-b-blue-500">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Sedang Diproses</span>
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">{{ $countDiproses ?? 0 }}</h3>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-center border-b-4 border-b-green-500">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Terselesaikan</span>
                        <div class="w-8 h-8 rounded-full bg-green-50 text-green-500 flex items-center justify-center"><i class="fa-solid fa-check-double"></i></div>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f]">{{ $countSelesai ?? 0 }}</h3>
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
                        
                        @forelse($complains as $complain)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors {{ $complain->status == 'selesai' ? 'opacity-70' : '' }}">
                            <td class="py-4 px-6 align-top">
                                <div class="font-bold text-[#1e3a5f]">
                                    @if($complain->is_anonymous)
                                        <i class="fa-solid fa-user-secret text-gray-400 mr-1"></i> Penghuni Anonim
                                    @else
                                        {{ $complain->user->name ?? 'Penghuni' }}
                                    @endif
                                </div>
                                <span class="text-xs text-gray-500 block mb-1">
                                    {{ $complain->room->name ?? 'Umum' }} 
                                    @if($complain->room && $complain->room->billings->where('user_id', $complain->user_id)->first())
                                        ( {{ $complain->room->billings->where('user_id', $complain->user_id)->first()->assigned_room_number ?? '-' }} )
                                    @endif
                                </span>
                                <span class="text-[10px] text-gray-400"><i class="fa-regular fa-clock"></i> {{ $complain->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="py-4 px-6 align-top">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 mb-1">{{ $complain->category }}</span>
                                @if($complain->visibility == 'public')
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-600 mb-1 ml-1" title="Dapat dilihat oleh semua penghuni kos"><i class="fa-solid fa-bullhorn"></i> Publik</span>
                                @else
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-500 mb-1 ml-1" title="Hanya Anda yang dapat melihat komplain ini"><i class="fa-solid fa-lock"></i> Privat</span>
                                @endif
                                <h4 class="font-bold text-slate-800 mb-1">{{ $complain->title }}</h4>
                                <p class="text-xs text-gray-500 line-clamp-2">{{ $complain->description }}</p>
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                @if($complain->priority == 'tinggi')
                                <span class="bg-red-100 text-red-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider"><i class="fa-solid fa-angles-up mr-1"></i> Tinggi</span>
                                @elseif($complain->priority == 'sedang')
                                <span class="bg-yellow-100 text-yellow-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Sedang</span>
                                @else
                                <span class="bg-blue-100 text-blue-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider"><i class="fa-solid fa-angle-down mr-1"></i> Rendah</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                @if($complain->status == 'menunggu')
                                <span class="bg-orange-100 text-orange-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Menunggu</span>
                                @elseif($complain->status == 'diproses')
                                <span class="bg-blue-100 text-blue-600 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Diproses</span>
                                @else
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Selesai</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 align-top text-center">
                                <button class="bg-[#38a38e] text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-teal-700 transition-colors shadow-sm w-full mb-1">Aksi</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">
                                <i class="fa-regular fa-face-smile-beam text-3xl mb-3 block text-gray-300"></i>
                                Belum ada keluhan dari penghuni.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <!-- MODAL BUAT PENGUMUMAN -->
    <div id="broadcastModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('broadcastModal').classList.add('hidden')"></div>
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg z-10 relative overflow-hidden flex flex-col transform transition-all">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-lg text-[#1e3a5f]"><i class="fa-solid fa-bullhorn text-orange-500 mr-2"></i> Buat Pengumuman Broadcast</h3>
                <button onclick="document.getElementById('broadcastModal').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">Pengumuman akan muncul di Papan Pengumuman pada dashboard seluruh penghuni kos ini.</p>
                <form action="{{ route('property.complains.broadcast', $property->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Judul Pengumuman <span class="text-red-500">*</span></label>
                        <input type="text" name="title" required placeholder="Contoh: Info Pemadaman Listrik" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Isi Pesan <span class="text-red-500">*</span></label>
                        <textarea name="description" required rows="4" placeholder="Tulis pesan lengkap di sini..." class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors"></textarea>
                    </div>
                    
                    <div class="flex gap-3 justify-end">
                        <button type="button" onclick="document.getElementById('broadcastModal').classList.add('hidden')" class="px-5 py-2 rounded-lg text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</button>
                        <button type="submit" class="px-5 py-2 rounded-lg text-sm font-bold text-white bg-orange-500 hover:bg-orange-600 transition-colors"><i class="fa-solid fa-paper-plane mr-1"></i> Kirim Broadcast</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
