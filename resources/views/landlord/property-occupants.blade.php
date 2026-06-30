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
                <i class="fa-solid fa-users mr-3 text-[#38a38e]"></i> Manajemen Penghuni
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama penghuni..." class="pl-9 pr-4 py-2 bg-slate-100 border-transparent rounded-lg text-sm focus:border-[#38a38e] focus:bg-white focus:ring-0 transition-colors w-64">
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <!-- TAB NAVIGASI -->
            <div class="flex border-b border-gray-200 mb-6">
                <button id="tab-aktif" onclick="switchTab('aktif')" class="px-6 py-3 font-bold text-[#38a38e] border-b-2 border-[#38a38e]">Aktif ({{ $activeOccupants->count() }})</button>
                <button id="tab-mantan" onclick="switchTab('mantan')" class="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors">Mantan Penghuni ({{ $inactiveOccupants->count() }})</button>
            </div>

            <!-- TABEL PENGHUNI -->
            <div id="table-aktif" class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
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
                        @forelse($activeOccupants as $billing)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold mr-3 uppercase">{{ substr($billing->user->name ?? 'U', 0, 2) }}</div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-[#1e3a5f]">{{ $billing->user->name ?? 'Penghuni' }}</span>
                                        <span class="text-xs text-gray-500">{{ $billing->user->phone_number ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-700">{{ $billing->room->name ?? 'Kamar' }}</span>
                                @if($billing->assigned_room_number)
                                <span class="inline-block bg-[#38a38e]/10 text-[#38a38e] text-[10px] font-bold px-2 py-0.5 rounded ml-1">{{ $billing->assigned_room_number }}</span>
                                @endif
                                <span class="block text-xs text-gray-500">Durasi: {{ $billing->duration ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                <i class="fa-regular fa-calendar text-gray-400 mr-1"></i> {{ \Carbon\Carbon::parse($billing->created_at)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($billing->status == 'paid')
                                <span class="bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-xs">Aktif</span>
                                @else
                                <span class="bg-yellow-100 text-yellow-700 font-bold px-3 py-1 rounded-full text-xs">Menunggu</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-gray-400 hover:text-blue-500 mx-1 transition-colors" title="Kirim Pesan" onclick="window.open('https://wa.me/{{ preg_replace('/[^0-9]/', '', $billing->user->phone_number ?? '') }}')"><i class="fa-brands fa-whatsapp"></i></button>
                                <button class="text-gray-400 hover:text-[#38a38e] mx-1 transition-colors" title="Pindah Kamar" onclick="openMoveModal({{ $billing->id }}, '{{ $billing->user->name ?? 'Penghuni' }}')"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
                                <button class="text-gray-400 hover:text-red-500 mx-1 transition-colors" title="Akhiri Sewa" onclick="openEvictModal({{ $billing->id }}, '{{ $billing->user->name ?? 'Penghuni' }}')"><i class="fa-solid fa-user-xmark"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">
                                <i class="fa-solid fa-users-slash text-3xl mb-3 block text-gray-300"></i>
                                Belum ada penghuni aktif.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TABEL MANTAN PENGHUNI -->
            <div id="table-mantan" class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-200">
                            <th class="py-4 px-6 font-semibold">Profil Penghuni</th>
                            <th class="py-4 px-6 font-semibold">Kamar Sebelumnya</th>
                            <th class="py-4 px-6 font-semibold">Tanggal Berakhir</th>
                            <th class="py-4 px-6 font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($inactiveOccupants as $billing)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold mr-3 uppercase">{{ substr($billing->user->name ?? 'U', 0, 2) }}</div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-600">{{ $billing->user->name ?? 'Penghuni' }}</span>
                                        <span class="text-xs text-gray-400">{{ $billing->user->phone_number ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-500">
                                {{ $billing->room->name ?? 'Kamar' }}
                                @if($billing->assigned_room_number)
                                <span class="inline-block bg-gray-100 text-gray-500 text-[10px] font-bold px-2 py-0.5 rounded ml-1">{{ $billing->assigned_room_number }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-500">
                                <i class="fa-regular fa-calendar-xmark text-gray-400 mr-1"></i> {{ \Carbon\Carbon::parse($billing->updated_at)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-gray-100 text-gray-500 font-bold px-3 py-1 rounded-full text-xs">Mantan</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">
                                <i class="fa-solid fa-users-slash text-3xl mb-3 block text-gray-300"></i>
                                Belum ada mantan penghuni.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <!-- MODAL PINDAH KAMAR -->
    <div id="moveModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('moveModal').classList.add('hidden')"></div>
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md z-10 relative overflow-hidden flex flex-col transform transition-all">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-lg text-[#1e3a5f]">Pindah Kamar</h3>
                <button onclick="document.getElementById('moveModal').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">Pindahkan <strong id="move_occupant_name" class="text-slate-800"></strong> ke tipe kamar baru:</p>
                <form id="formMoveRoom" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tipe Kamar Baru <span class="text-red-500">*</span></label>
                        <select name="room_id" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors appearance-none">
                            @foreach($property->rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }} (Rp{{ number_format($room->price_monthly, 0, ',', '.') }}/bln)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Kamar Baru <span class="text-red-500">*</span></label>
                        <input type="text" name="assigned_room_number" required placeholder="Contoh: Kamar B2, No. 10" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                    </div>
                    
                    <div class="flex gap-3 justify-end">
                        <button type="button" onclick="document.getElementById('moveModal').classList.add('hidden')" class="px-5 py-2 rounded-lg text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</button>
                        <button type="submit" class="px-5 py-2 rounded-lg text-sm font-bold text-white bg-[#38a38e] hover:bg-teal-700 transition-colors">Simpan Kepindahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL AKHIRI SEWA -->
    <div id="evictModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('evictModal').classList.add('hidden')"></div>
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md z-10 relative overflow-hidden flex flex-col transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-user-xmark text-3xl text-red-500"></i>
                </div>
                <h3 class="font-bold text-xl text-slate-800 mb-2">Akhiri Sewa?</h3>
                <p class="text-sm text-slate-500 mb-6">
                    Anda akan mengakhiri masa sewa untuk <strong id="evict_occupant_name" class="text-slate-700"></strong>. Penghuni ini akan dipindahkan ke daftar <strong class="text-slate-700">Mantan Penghuni</strong>.
                </p>
                <form id="formEvictRoom" method="POST">
                    @csrf
                    <div class="flex gap-3 justify-center">
                        <button type="button" onclick="document.getElementById('evictModal').classList.add('hidden')" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white bg-red-500 hover:bg-red-600 shadow-lg shadow-red-500/30 transition-all active:scale-95">Ya, Akhiri Sewa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const btnAktif = document.getElementById('tab-aktif');
            const btnMantan = document.getElementById('tab-mantan');
            const tableAktif = document.getElementById('table-aktif');
            const tableMantan = document.getElementById('table-mantan');

            if(tab === 'aktif') {
                btnAktif.className = "px-6 py-3 font-bold text-[#38a38e] border-b-2 border-[#38a38e]";
                btnMantan.className = "px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors";
                tableAktif.classList.remove('hidden');
                tableMantan.classList.add('hidden');
            } else {
                btnMantan.className = "px-6 py-3 font-bold text-[#38a38e] border-b-2 border-[#38a38e]";
                btnAktif.className = "px-6 py-3 font-medium text-gray-500 hover:text-gray-700 transition-colors";
                tableMantan.classList.remove('hidden');
                tableAktif.classList.add('hidden');
            }
        }

        function openMoveModal(billingId, name) {
            document.getElementById('move_occupant_name').innerText = name;
            document.getElementById('formMoveRoom').action = `/property/{{ $property->id }}/occupants/${billingId}/move`;
            document.getElementById('moveModal').classList.remove('hidden');
        }

        function openEvictModal(billingId, name) {
            document.getElementById('evict_occupant_name').innerText = name;
            document.getElementById('formEvictRoom').action = `/property/{{ $property->id }}/occupants/${billingId}/evict`;
            document.getElementById('evictModal').classList.remove('hidden');
        }
    </script>
</body>
</html>
