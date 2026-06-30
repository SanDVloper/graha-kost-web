<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Admin GRAHA</title>
    
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
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors font-bold">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <span class="ml-3">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-user-gear mr-3 text-[#38a38e]"></i> Pengaturan Akun Admin
            </div>
            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-teal-200 text-teal-700 flex items-center justify-center font-bold mr-3 uppercase drop-shadow-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-800 text-sm">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-teal-600 font-medium">Super Admin</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-4xl mx-auto space-y-8">
                @if(session('success'))
                    <div class="bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-regular fa-id-badge text-teal-600 mr-3"></i> Profil Pengguna
                    </h3>
                    <form action="{{ route('settings.profile') }}" method="POST" class="flex flex-col md:flex-row gap-8 items-start">
                        @csrf
                        <div class="flex flex-col items-center space-y-3">
                            <div class="w-24 h-24 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center text-3xl font-bold uppercase border-4 border-white shadow-md relative group cursor-pointer overflow-hidden">
                                {{ substr(auth()->user()->name, 0, 2) }}
                                <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center transition-all">
                                    <i class="fa-solid fa-camera text-white text-xl"></i>
                                </div>
                            </div>
                            <button type="button" class="text-xs font-bold text-[#38a38e] hover:underline">Ubah Foto</button>
                        </div>

                        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" readonly>
                                <p class="text-[10px] text-gray-400 mt-1">*Email tidak dapat diubah dari dashboard.</p>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-200 bg-gray-50 text-gray-500 text-sm font-bold">+62</span>
                                    <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="81234567890" class="flex-1 bg-slate-50 border border-gray-200 rounded-r-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <button type="submit" class="bg-[#1e3a5f] text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-900 transition-colors shadow-sm mt-2">
                                    Simpan Profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-shield-halved text-teal-600 mr-3"></i> Keamanan & Password
                    </h3>
                    <form action="{{ route('settings.password') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-2xl">
                        @csrf
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password" placeholder="••••••••" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" required>
                            @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" required>
                            @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" required>
                        </div>
                        <div class="col-span-2 mt-2">
                            <button type="submit" class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>


