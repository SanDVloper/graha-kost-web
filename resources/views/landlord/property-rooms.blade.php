<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamar & Fasilitas - {{ $property->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

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

                <a href="{{ route('property.rooms', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors whitespace-nowrap">
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

                <a href="{{ route('property.complains', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-6 shrink-0 flex justify-center"><i class="fa-regular fa-envelope"></i></div>
                        <span class="ml-3 sidebar-text">Keluhan</span>
                        <!-- Contoh Badge Notifikasi -->
                        <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-2 sidebar-text">2</span>
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

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-bed mr-3 text-[#38a38e]"></i> Kamar & Fasilitas
            </div>
            <button onclick="document.getElementById('addRoomModal').classList.remove('hidden')" class="bg-[#38a38e] hover:bg-teal-700 text-white px-5 py-2 rounded-lg font-bold text-sm transition-all shadow-md">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Tipe Kamar
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg shadow-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Daftar Unit Kamar</h2>
                <p class="text-gray-500">Kelola status ketersediaan dan penghuni di setiap unit.</p>
            </div>

            @if($property->rooms->isEmpty())
                <div class="bg-white rounded-xl border border-gray-200 p-12 text-center shadow-sm">
                    <i class="fa-solid fa-bed text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-bold text-gray-700">Belum Ada Tipe Kamar</h3>
                    <p class="text-gray-500 mt-2">Silakan klik tombol "Tambah Tipe Kamar" untuk mulai menyewakan properti Anda.</p>
                </div>
            @else
                @foreach($property->rooms as $roomType)
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-4">
                            <h3 class="text-lg font-bold text-[#1e3a5f] bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm flex items-center">
                                Tipe: {{ $roomType->name }} 
                                <span class="ml-2 text-xs font-normal text-gray-400">({{ $roomType->quantity }} Unit)</span>
                            </h3>
                            <div class="h-px flex-1 bg-gray-200"></div>
                            
                            <button onclick='openEditModal(@json($roomType))' class="w-8 h-8 rounded bg-white border border-gray-200 text-gray-400 hover:text-blue-500 hover:border-blue-500 transition-colors shadow-sm flex items-center justify-center">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </div>
                        
                        <!-- Rincian Tipe Kamar -->
                        <div class="mb-4 bg-white p-4 rounded-lg border border-gray-200 flex flex-wrap gap-x-8 gap-y-4 text-sm shadow-sm">
                            <div><span class="text-gray-400 block text-xs font-semibold uppercase">Ukuran</span> <span class="font-bold text-slate-700">{{ $roomType->size }} m²</span></div>
                            <div><span class="text-gray-400 block text-xs font-semibold uppercase">Bulanan</span> <span class="font-bold text-[#38a38e]">Rp {{ number_format($roomType->price_monthly, 0, ',', '.') }}</span></div>
                            <div><span class="text-gray-400 block text-xs font-semibold uppercase">Harian</span> <span class="font-bold text-[#38a38e]">{{ $roomType->price_daily ? 'Rp '.number_format($roomType->price_daily, 0, ',', '.') : '-' }}</span></div>
                            <div><span class="text-gray-400 block text-xs font-semibold uppercase">Tahunan</span> <span class="font-bold text-[#38a38e]">{{ $roomType->price_yearly ? 'Rp '.number_format($roomType->price_yearly, 0, ',', '.') : '-' }}</span></div>
                            
                            <div class="w-full">
                                <span class="text-gray-400 block text-xs font-semibold uppercase mb-1">Fasilitas Dalam Kamar</span>
                                <div class="flex flex-wrap gap-2">
                                    @if(is_array($roomType->facilities) && count($roomType->facilities) > 0)
                                        @foreach($roomType->facilities as $fac)
                                            <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md text-xs font-medium border border-gray-200"><i class="fa-solid fa-check text-[#38a38e] mr-1"></i>{{ $fac }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-xs text-gray-400 italic">Belum ada fasilitas.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @for($i = 1; $i <= $roomType->quantity; $i++)
                                @php
                                    // Simulasi: Anggap saja unit nomor 1 & 3 sudah ada penghuninya
                                    $isOccupied = ($i == 1 || $i == 3);
                                    $occupantName = $isOccupied ? ($i == 1 ? "Budi Santoso" : "Siti Aminah") : null;
                                @endphp

                                <div class="bg-white rounded-xl border-2 {{ $isOccupied ? 'border-teal-100 bg-white' : 'border-dashed border-gray-200 bg-gray-50/30' }} p-5 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                                    @if($isOccupied)
                                        <div class="absolute top-0 left-0 w-1 h-full bg-[#38a38e]"></div>
                                    @endif
                                    
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="w-12 h-12 rounded-lg {{ $isOccupied ? 'bg-teal-50 text-[#38a38e]' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center font-bold text-lg">
                                            {{ $i }}
                                        </div>
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $isOccupied ? 'bg-teal-50 text-[#38a38e] border border-teal-100' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                                            {{ $isOccupied ? 'Terisi' : 'Tersedia' }}
                                        </span>
                                    </div>

                                    <div class="space-y-1">
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Penghuni</p>
                                        @if($isOccupied)
                                            <p class="font-bold text-[#1e3a5f] truncate">{{ $occupantName }}</p>
                                            <p class="text-[11px] text-gray-500"><i class="fa-regular fa-calendar-check mr-1"></i> Sejak 12 Jan 2024</p>
                                        @else
                                            <p class="text-sm italic text-gray-400">Kosong</p>
                                            <button class="mt-2 text-[#38a38e] text-xs font-bold hover:underline">
                                                <i class="fa-solid fa-user-plus mr-1"></i> Tambahkan Penghuni
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </main>

    <!-- MODAL TAMBAH KAMAR -->
    <div id="addRoomModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="document.getElementById('addRoomModal').classList.add('hidden')"></div>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl z-10 relative overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-lg text-[#1e3a5f]"><i class="fa-solid fa-plus text-[#38a38e] mr-2"></i> Tambah Tipe Kamar Baru</h3>
                <button onclick="document.getElementById('addRoomModal').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <div class="p-6 overflow-y-auto">
                <form action="{{ route('property.rooms.store', $property->id) }}" method="POST" id="formAddRoom">
                    @csrf
                    <div class="grid grid-cols-2 gap-5 mb-5">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Tipe (Misal: VIP AC)</label>
                            <input type="text" name="name" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ukuran Kamar (Misal: 3x4)</label>
                            <input type="text" name="size" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Unit (Stok)</label>
                            <input type="number" name="quantity" min="1" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                    </div>
                    
                    <h4 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2 mb-4">Harga Sewa (Rp)</h4>
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Bulanan (Wajib)</label>
                            <input type="number" name="price_monthly" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Harian (Opsional)</label>
                            <input type="number" name="price_daily" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Tahunan (Opsional)</label>
                            <input type="number" name="price_yearly" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2 mb-4">Fasilitas Kamar</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(['Kasur', 'Lemari', 'Meja & Kursi', 'AC', 'Kipas Angin', 'Kamar Mandi Dalam', 'Kloset Duduk', 'Water Heater', 'TV', 'Jendela', 'Balkon'] as $fac)
                        <label class="flex items-center space-x-2 cursor-pointer p-2 border border-gray-100 rounded hover:bg-slate-50 transition-colors">
                            <input type="checkbox" name="facilities[]" value="{{ $fac }}" class="rounded text-[#38a38e] focus:ring-[#38a38e]">
                            <span class="text-sm text-gray-600">{{ $fac }}</span>
                        </label>
                        @endforeach
                    </div>
                </form>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addRoomModal').classList.add('hidden')" class="px-5 py-2 rounded-lg text-sm font-bold text-gray-500 hover:bg-gray-200 transition-colors">Batal</button>
                <button type="submit" form="formAddRoom" class="px-5 py-2 rounded-lg text-sm font-bold bg-[#38a38e] text-white hover:bg-teal-700 transition-colors">Simpan Kamar</button>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT KAMAR -->
    <div id="editRoomModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="document.getElementById('editRoomModal').classList.add('hidden')"></div>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl z-10 relative overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-lg text-[#1e3a5f]"><i class="fa-solid fa-pen text-[#38a38e] mr-2"></i> Edit Tipe Kamar</h3>
                <button onclick="document.getElementById('editRoomModal').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <div class="p-6 overflow-y-auto">
                <form id="formEditRoom" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-5 mb-5">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Tipe</label>
                            <input type="text" name="name" id="edit_name" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ukuran Kamar</label>
                            <input type="text" name="size" id="edit_size" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Unit (Stok)</label>
                            <input type="number" name="quantity" id="edit_quantity" min="1" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                    </div>
                    
                    <h4 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2 mb-4">Harga Sewa (Rp)</h4>
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Bulanan (Wajib)</label>
                            <input type="number" name="price_monthly" id="edit_price_monthly" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Harian (Opsional)</label>
                            <input type="number" name="price_daily" id="edit_price_daily" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Tahunan (Opsional)</label>
                            <input type="number" name="price_yearly" id="edit_price_yearly" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-[#38a38e] focus:bg-white outline-none transition-colors">
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2 mb-4">Fasilitas Kamar</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(['Kasur', 'Lemari', 'Meja & Kursi', 'AC', 'Kipas Angin', 'Kamar Mandi Dalam', 'Kloset Duduk', 'Water Heater', 'TV', 'Jendela', 'Balkon'] as $fac)
                        <label class="flex items-center space-x-2 cursor-pointer p-2 border border-gray-100 rounded hover:bg-slate-50 transition-colors">
                            <input type="checkbox" name="facilities[]" value="{{ $fac }}" class="edit_facility_checkbox rounded text-[#38a38e] focus:ring-[#38a38e]">
                            <span class="text-sm text-gray-600">{{ $fac }}</span>
                        </label>
                        @endforeach
                    </div>
                </form>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center gap-3">
                <form id="formDeleteRoom" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmSafeDelete()" class="px-4 py-2 rounded-lg text-sm font-bold text-red-500 hover:bg-red-50 transition-colors border border-transparent hover:border-red-200">
                        <i class="fa-solid fa-trash mr-1"></i> Hapus Seluruh Tipe Kamar
                    </button>
                </form>
                
                <div class="flex gap-2">
                    <button type="button" onclick="document.getElementById('editRoomModal').classList.add('hidden')" class="px-5 py-2 rounded-lg text-sm font-bold text-gray-500 hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" form="formEditRoom" class="px-5 py-2 rounded-lg text-sm font-bold bg-[#38a38e] text-white hover:bg-teal-700 transition-colors">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmSafeDelete() {
            let confirmation = prompt("PERINGATAN: Menghapus tipe kamar ini akan menghapus semua unit dan data tagihan di dalamnya!\n\nKetik 'HAPUS' (tanpa tanda kutip) untuk melanjutkan:");
            if (confirmation === 'HAPUS') {
                document.getElementById('formDeleteRoom').submit();
            } else if (confirmation !== null) {
                alert("Penghapusan dibatalkan karena kata kunci tidak cocok.");
            }
        }

        function openEditModal(room) {
            const form = document.getElementById('formEditRoom');
            form.action = `/property/{{ $property->id }}/rooms/${room.id}`;
            
            const deleteForm = document.getElementById('formDeleteRoom');
            deleteForm.action = `/property/{{ $property->id }}/rooms/${room.id}`;
            
            document.getElementById('edit_name').value = room.name;
            document.getElementById('edit_size').value = room.size;
            document.getElementById('edit_quantity').value = room.quantity;
            document.getElementById('edit_price_monthly').value = room.price_monthly;
            document.getElementById('edit_price_daily').value = room.price_daily || '';
            document.getElementById('edit_price_yearly').value = room.price_yearly || '';
            
            // Uncheck all first
            document.querySelectorAll('.edit_facility_checkbox').forEach(cb => {
                cb.checked = false;
                if(room.facilities && room.facilities.includes(cb.value)) {
                    cb.checked = true;
                }
            });
            
            document.getElementById('editRoomModal').classList.remove('hidden');
        }
    </script>
</body>
</html>
