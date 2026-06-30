<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - GRAHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

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
            <a href="{{ route('landlord.dashboard') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg mb-6 whitespace-nowrap transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3 sidebar-text">Dashboard Utama</span>
            </a>


        
            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4 sidebar-text whitespace-nowrap">System</div>
            
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

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-gear mr-3 text-[#38a38e]"></i> Settings
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('profile.show') }}" class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-lg transition-colors">
                    <div class="w-10 h-10 rounded-full bg-teal-200 text-teal-700 flex items-center justify-center font-bold mr-3 uppercase drop-shadow-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-800 text-sm">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-teal-600 font-medium">{{ auth()->user()->role == 'tuan_kos' ? 'Pemilik Kos' : 'Pencari Kos' }}</span>
                    </div>
                </a>
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



                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                        <i class="fa-solid fa-headset text-teal-600 mr-3"></i> Pusat Bantuan & Kebijakan
                    </h3>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20GRAHA,%20saya%20butuh%20bantuan" target="_blank" class="flex-1 border border-gray-200 rounded-lg p-4 flex items-center justify-center hover:bg-green-50 hover:text-green-600 transition-colors text-sm font-bold text-gray-700">
                            <i class="fa-brands fa-whatsapp text-green-500 mr-2 text-xl"></i> Hubungi Admin GRAHA
                        </a>
                        <button onclick="document.getElementById('terms-modal').classList.remove('hidden')" class="flex-1 border border-gray-200 rounded-lg p-4 flex items-center justify-center hover:bg-blue-50 hover:text-blue-600 transition-colors text-sm font-bold text-gray-700">
                            <i class="fa-solid fa-file-contract text-blue-500 mr-2 text-xl"></i> Syarat & Ketentuan
                        </button>
                    </div>
                </div>

                <!-- Terms Modal -->
                <div id="terms-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="document.getElementById('terms-modal').classList.add('hidden')">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-xl leading-6 font-bold text-gray-900 mb-4" id="modal-title">
                                            Syarat & Ketentuan GRAHA
                                        </h3>
                                        <div class="mt-2 text-sm text-gray-500 h-64 overflow-y-auto pr-2 space-y-4">
                                            <p>Selamat datang di platform GRAHA. Dengan menggunakan layanan kami, Anda menyetujui syarat dan ketentuan berikut:</p>
                                            <h4 class="font-bold text-gray-700">1. Tanggung Jawab Pemilik Kos</h4>
                                            <p>Pemilik kos bertanggung jawab penuh atas keakuratan data properti, harga, dan ketersediaan kamar yang ditampilkan di platform GRAHA.</p>
                                            <h4 class="font-bold text-gray-700">2. Transaksi dan Pembayaran</h4>
                                            <p>Semua transaksi pembayaran sewa yang dilakukan melalui GRAHA akan diverifikasi secara otomatis. GRAHA tidak bertanggung jawab atas transaksi yang dilakukan di luar platform.</p>
                                            <h4 class="font-bold text-gray-700">3. Privasi Data</h4>
                                            <p>Data pribadi Anda dan penghuni akan dijaga kerahasiaannya dan hanya digunakan untuk keperluan operasional sistem manajemen kos.</p>
                                            <h4 class="font-bold text-gray-700">4. Penonaktifan Akun</h4>
                                            <p>GRAHA berhak menonaktifkan akun pemilik kos jika ditemukan pelanggaran, penipuan, atau laporan berulang dari penghuni terkait fasilitas yang tidak sesuai.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" onclick="document.getElementById('terms-modal').classList.add('hidden')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Saya Mengerti
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
</div>
        </div>
    </main>

</body>
</html>
