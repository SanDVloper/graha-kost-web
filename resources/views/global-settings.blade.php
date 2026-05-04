<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - GRAHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR GLOBAL (Sama seperti Dashboard Utama) -->
    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden whitespace-nowrap">
            <div class="mr-3 shrink-0 flex items-center justify-center w-10">
                <img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="w-full h-auto drop-shadow-sm">
            </div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl text-slate-800 tracking-wide">GRAHA</h1>
                <p class="text-[0.6rem] text-teal-600 font-semibold uppercase tracking-wider">Sistem Pusat</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto overflow-x-hidden">
            <a href="{{ url('/') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg mb-6 whitespace-nowrap transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3 sidebar-text">Dashboard Utama</span>
            </a>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4 sidebar-text whitespace-nowrap">System</div>
            
            <!-- Menu Pengaturan Global (Active) -->
            <a href="{{ route('settings.global') }}" class="flex items-center px-4 py-3 bg-teal-50 text-teal-600 rounded-lg transition-colors whitespace-nowrap">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="font-bold ml-3 sidebar-text">Settings</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors whitespace-nowrap font-bold">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <span class="ml-3 sidebar-text">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-user-gear mr-3 text-[#38a38e]"></i> Pengaturan Akun Global
            </div>

            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-teal-200 text-teal-700 flex items-center justify-center font-bold mr-3 uppercase drop-shadow-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-800 text-sm">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-teal-600 font-medium">{{ auth()->user()->role == 'tuan_kos' ? 'Pemilik Kos' : 'Pencari Kos' }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-4xl mx-auto space-y-8">

                <!-- PROFIL PENGGUNA -->
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-regular fa-id-badge text-teal-600 mr-3"></i> Profil Pengguna
                    </h3>
                    
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <!-- Avatar Upload -->
                        <div class="flex flex-col items-center space-y-3">
                            <div class="w-24 h-24 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center text-3xl font-bold uppercase border-4 border-white shadow-md relative group cursor-pointer overflow-hidden">
                                {{ substr(auth()->user()->name, 0, 2) }}
                                <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center transition-all">
                                    <i class="fa-solid fa-camera text-white text-xl"></i>
                                </div>
                            </div>
                            <button class="text-xs font-bold text-[#38a38e] hover:underline">Ubah Foto</button>
                        </div>

                        <!-- Form Data Diri -->
                        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" readonly>
                                <p class="text-[10px] text-gray-400 mt-1">*Email digunakan untuk login, hubungi admin untuk mengubah.</p>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-200 bg-gray-50 text-gray-500 text-sm font-bold">+62</span>
                                    <input type="text" placeholder="81234567890" class="flex-1 bg-slate-50 border border-gray-200 rounded-r-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <button class="bg-[#1e3a5f] text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-900 transition-colors shadow-sm mt-2">
                                    Simpan Profil
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KEAMANAN (UBAH PASSWORD) -->
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-shield-halved text-teal-600 mr-3"></i> Keamanan & Password
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-2xl">
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" placeholder="••••••••" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" placeholder="Ketik ulang password baru" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                        </div>
                        <div class="col-span-2 mt-2">
                            <button class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                                Update Password
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>