<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Enrollment - Admin GRAHA</title>
    
    <!-- MENGGUNAKAN STANDAR GRAHA: Vite, FontAwesome, dan Font Inter -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery untuk logika form -->
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
            @if(auth()->user()->hasPermission('dashboard'))
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg mb-2 transition-colors {{ Request::routeIs('admin.dashboard') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3">Dashboard</span>
            </a>
            @endif
            
            @if(auth()->user()->hasPermission('enrollment'))
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.enrollment') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-user-check"></i></div>
                <span class="font-bold ml-3">Enrollment</span>
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
                    <p class="font-bold text-sm text-slate-800">Guntur Putra</p>
                    <p class="text-xs text-gray-400">Super Admin</p>
                </div>
            </div>
        </div>
    </aside>

  <!-- MAIN CONTENT -->
<div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">

    <!-- TOPBAR -->
    <header class="h-20 bg-white border-b border-gray-200 px-8 flex items-center justify-between shrink-0">

        <div>
            <h1 class="text-3xl font-bold text-[#1e3a5f]">
                Manajemen Pengguna
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola seluruh pengguna aplikasi GRAHA
            </p>
        </div>

        <!-- SEARCH -->
        <div class="relative w-[320px]">

            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

            <input type="text"
                   placeholder="Cari pengguna..."
                   class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200
                          bg-slate-50 text-sm focus:outline-none
                          focus:ring-2 focus:ring-[#38a38e]/20
                          focus:border-[#38a38e]">

        </div>

    </header>

    <!-- CONTENT -->
    <div class="flex-1 overflow-y-auto p-8">

        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

            <!-- HEADER -->
            <div class="px-8 py-6 border-b border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-2xl font-bold text-[#1e3a5f]">
                            Data Pengguna
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Kelompok pengguna berdasarkan role
                        </p>
                    </div>

                    <div class="flex items-center gap-3">

                        <div class="px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-sm font-bold">
                            3 Admin
                        </div>

                        <div class="px-4 py-2 rounded-xl bg-green-50 text-green-600 text-sm font-bold">
                            12 Pengguna
                        </div>

                        <div class="px-4 py-2 rounded-xl bg-orange-50 text-orange-600 text-sm font-bold">
                            5 Owner
                        </div>

                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="p-8 space-y-6">

                <!-- ================================= -->
                <!-- ADMIN -->
                <!-- ================================= -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-6 py-5 bg-slate-50 flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-[#1e3a5f]
                                        text-white flex items-center justify-center text-xl">

                                <i class="fa-solid fa-user-shield"></i>

                            </div>

                            <div>

                                <h3 class="text-xl font-bold text-[#1e3a5f]">
                                    Administrator
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Pengelola sistem aplikasi GRAHA
                                </p>

                            </div>

                        </div>

                        <div class="flex items-center gap-3">
                            @if(auth()->user()->is_super_admin)
                            <button onclick="openCreateAdminModal()"
                                    class="px-5 py-3 rounded-xl bg-white border border-[#1e3a5f]
                                           text-[#1e3a5f] hover:bg-gray-50
                                           text-sm font-bold transition">
                                <i class="fa-solid fa-plus mr-2"></i> Tambah Admin
                            </button>
                            @endif
                            <button onclick="toggleSection('adminSection')"
                                    class="px-5 py-3 rounded-xl bg-[#1e3a5f]
                                           hover:bg-[#16324a] text-white
                                           text-sm font-bold transition">

                                <i class="fa-solid fa-users mr-2"></i>
                                Lihat User

                            </button>
                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div id="adminSection" class="hidden p-6 bg-white border-t border-gray-100">

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

                            <!-- CARD -->
                            <div class="border border-gray-100 rounded-2xl p-5 hover:bg-slate-50 transition">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-4">

                                        <div class="w-14 h-14 rounded-full bg-[#1e3a5f]
                                                    text-white flex items-center justify-center font-bold">

                                            GP

                                        </div>

                                        <div>

                                            <h4 class="font-bold text-[#1e3a5f] text-lg">
                                                Guntur Putra
                                            </h4>

                                            <p class="text-sm text-gray-500">
                                                guntur@mail.com
                                            </p>

                                        </div>

                                    </div>

                                    <span class="px-3 py-1 rounded-full
                                                 bg-blue-50 text-blue-600
                                                 text-xs font-bold">

                                        Admin

                                    </span>

                                </div>

                                <button class="mt-5 w-full border border-[#1e3a5f]
                                               text-[#1e3a5f] hover:bg-[#1e3a5f]
                                               hover:text-white transition
                                               py-2.5 rounded-xl text-sm font-semibold">

                                    Lihat Detail

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- ================================= -->
                <!-- PENGGUNA -->
                <!-- ================================= -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-6 py-5 bg-slate-50 flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-[#38a38e]
                                        text-white flex items-center justify-center text-xl">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <div>

                                <h3 class="text-xl font-bold text-[#38a38e]">
                                    Pengguna Kost
                                </h3>

                                <p class="text-sm text-gray-500">
                                    User penghuni kost
                                </p>

                            </div>

                        </div>

                        <button onclick="toggleSection('penggunaSection')"
                                class="px-5 py-3 rounded-xl bg-[#38a38e]
                                       hover:bg-teal-700 text-white
                                       text-sm font-bold transition">

                            <i class="fa-solid fa-users mr-2"></i>
                            Lihat User

                        </button>

                    </div>

                    <!-- CONTENT -->
                    <div id="penggunaSection" class="hidden p-6 bg-white border-t border-gray-100">

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

                            <!-- USER -->
                            <div class="border border-gray-100 rounded-2xl p-5 hover:bg-slate-50 transition">

                                <div class="flex items-start justify-between">

                                    <div class="flex items-center gap-4">

                                        <div class="w-14 h-14 rounded-full bg-[#38a38e]
                                                    text-white flex items-center justify-center font-bold">

                                            SA

                                        </div>

                                        <div>

                                            <h4 class="font-bold text-[#1e3a5f] text-lg">
                                                Siti Aminah
                                            </h4>

                                            <p class="text-sm text-gray-500">
                                                siti@mail.com
                                            </p>

                                            <div class="flex items-center gap-2 mt-3">

                                                <span class="px-3 py-1 rounded-full
                                                             bg-green-50 text-green-600
                                                             text-xs font-bold">

                                                    Penghuni

                                                </span>

                                                <span class="px-3 py-1 rounded-full
                                                             bg-blue-50 text-blue-600
                                                             text-xs font-bold">

                                                    Kost Graha Asri

                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                    <button onclick="openUserDetailModal('Siti Aminah', 'siti@mail.com', 'Penghuni', '01 Jan 2026', 'Tinggal di Kost Graha Asri', '#38a38e')" 
        class="bg-[#38a38e] hover:bg-teal-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
    Detail
</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- ================================= -->
                <!-- OWNER -->
                <!-- ================================= -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-6 py-5 bg-slate-50 flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-orange-500
                                        text-white flex items-center justify-center text-xl">

                                <i class="fa-solid fa-building"></i>

                            </div>

                            <div>

                                <h3 class="text-xl font-bold text-orange-500">
                                    Owner Kost
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Pemilik property kost
                                </p>

                            </div>

                        </div>

                        <button onclick="toggleSection('ownerSection')"
                                class="px-5 py-3 rounded-xl bg-orange-500
                                       hover:bg-orange-600 text-white
                                       text-sm font-bold transition">

                            <i class="fa-solid fa-users mr-2"></i>
                            Lihat User

                        </button>

                    </div>

                    <!-- CONTENT -->
                    <div id="ownerSection" class="hidden p-6 bg-orange border-t border-gray-100">

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

                            <!-- OWNER -->
                            <div class="border border-orange-100 rounded-2xl p-5 hover:bg-slate-50 transition">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-4">

                                        <div class="w-14 h-14 rounded-full bg-orange-500
                                                    text-white flex items-center justify-center font-bold">

                                            BS

                                        </div>

                                        <div>

                                            <h4 class="font-bold text-[#1e3a5f] text-lg">
                                                Budi Santoso
                                            </h4>

                                            <p class="text-sm text-gray-500">
                                                budi@mail.com
                                            </p>

                                        </div>

                                    </div>

                                    <span class="px-3 py-1 rounded-full
                                                 bg-orange-50 text-orange-600
                                                 text-xs font-bold">

                                        Owner

                                    </span>

                                </div>

                                <!-- PROPERTY -->
                                <div class="mt-5">

                                    <p class="text-sm text-gray-500 font-semibold mb-3">
                                        Property Dimiliki
                                    </p>

                                    <div class="flex flex-wrap gap-2">

                                        <span class="px-3 py-1 rounded-full border
                                                     border-gray-300 text-xs font-semibold">

                                            Kost Graha Asri

                                        </span>

                                        <span class="px-3 py-1 rounded-full border
                                                     border-gray-300 text-xs font-semibold">

                                            Kost Melati Indah

                                        </span>

                                    </div>

                                </div>

                                <button onclick="openUserDetailModal('Budi Santoso', 'budi@mail.com', 'Owner', '15 Feb 2025', 'Memiliki 2 Properti', '#f97316')" 
        class="mt-5 w-full bg-orange-500 hover:bg-orange-600 text-white py-2.5 rounded-xl text-sm font-semibold transition">
    Lihat Detail
</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- SCRIPT -->

<!-- MODAL TAMBAH ADMIN -->
<div id="createAdminModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateAdminModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-[#1e3a5f]">Tambah Admin Baru</h3>
            <button onclick="closeCreateAdminModal()" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-times"></i></button>
        </div>
        <form method="POST" action="{{ route('admin.users.admin.store') }}">
            @csrf
            <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                <div>
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-1">Alamat Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-1">Kata Sandi</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
                </div>
                
                <div class="pt-2">
                    <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Hak Akses Menu</label>
                    <div class="grid grid-cols-2 gap-3">
                        @php
                        $availableMenus = [
                            'dashboard' => 'Dashboard',
                            'enrollment' => 'Verifikasi Akun',
                            'users' => 'Pengguna',
                            'detail' => 'Kost',
                            'tagihan' => 'Transaksi',
                            'complaints' => 'Komplain',
                            'laporan' => 'Laporan',
                            'pengaturan' => 'Pengaturan'
                        ];
                        @endphp
                        @foreach($availableMenus as $key => $label)
                        <label class="flex items-center gap-3 p-2 border border-gray-100 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}" class="w-4 h-4 text-[#1e3a5f] border-gray-300 rounded focus:ring-[#1e3a5f]">
                            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-slate-50">
                <button type="button" onclick="closeCreateAdminModal()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-semibold hover:bg-white">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#1e3a5f] text-white font-semibold hover:bg-[#16324a]">Simpan Admin</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL DETAIL PENGGUNA -->
<div id="userDetailModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeUserDetailModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-[#1e3a5f]">Detail Pengguna</h3>
            <button onclick="closeUserDetailModal()" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="p-6 flex flex-col items-center text-center">
            <div id="udAvatar" class="w-20 h-20 rounded-full text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                --
            </div>
            <h4 id="udName" class="text-xl font-bold text-slate-800">Nama</h4>
            <p id="udEmail" class="text-sm text-gray-500 mb-4">email@mail.com</p>
            
            <div class="w-full bg-slate-50 p-4 rounded-xl text-left space-y-3">
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase">Peran</span>
                    <span id="udRole" class="text-sm font-semibold text-[#1e3a5f]">Role</span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase">Bergabung</span>
                    <span id="udJoined" class="text-sm font-semibold text-[#1e3a5f]">Tanggal</span>
                </div>
                <div class="flex flex-col pt-1">
                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Informasi Tambahan</span>
                    <span id="udExtra" class="text-sm font-semibold text-gray-700">-</span>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-100 bg-slate-50">
            <button onclick="closeUserDetailModal()" class="w-full px-5 py-2.5 rounded-xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">Tutup</button>
        </div>
    </div>
</div>

<script>
function openCreateAdminModal() {
    document.getElementById('createAdminModal').classList.remove('hidden');
}
function closeCreateAdminModal() {
    document.getElementById('createAdminModal').classList.add('hidden');
}

function openUserDetailModal(name, email, role, joined, extraInfo, roleColor) {
    document.getElementById('udName').textContent = name;
    document.getElementById('udEmail').textContent = email;
    document.getElementById('udRole').textContent = role;
    document.getElementById('udJoined').textContent = joined;
    document.getElementById('udExtra').textContent = extraInfo;
    
    const avatar = document.getElementById('udAvatar');
    avatar.textContent = name.substring(0, 2).toUpperCase();
    avatar.style.backgroundColor = roleColor;
    
    document.getElementById('userDetailModal').classList.remove('hidden');
}
function closeUserDetailModal() {
    document.getElementById('userDetailModal').classList.add('hidden');
}
</script>
<script>

function toggleSection(id)
{
    const section = document.getElementById(id);

    section.classList.toggle('hidden');
}

</script>