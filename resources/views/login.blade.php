<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRAHA - Masuk atau Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8FAFC; }
        .form-input {
            width: 100%; border: 1px solid #E2E8F0; border-radius: 0.75rem;
            padding: 0.875rem 1rem; padding-left: 2.75rem; color: #1E293B;
            transition: all 0.2s; background-color: #F8FAFC;
        }
        .form-input:focus {
            outline: none; border-color: #0D9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1); background-color: #FFFFFF;
        }
        .role-radio:checked + div { border-color: #0D9488; background-color: #F0FDFA; }
        .role-radio:checked + div .role-icon { color: #0D9488; background-color: #CCFBF1; }
        .role-radio:checked + div .role-check { opacity: 1; transform: scale(1); }
        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="h-screen w-full overflow-hidden flex">

    <!-- LEFT PANEL: Branding & Illustration (Hidden on Mobile) -->
    <div class="hidden md:flex w-1/2 bg-[#1E3A8A] relative flex-col justify-between overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-teal-600 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

        <div class="p-12 relative z-10">
            <div class="flex items-center text-white mb-4">
                <img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="h-12 w-auto mr-3 brightness-0 invert">
                <h1 class="text-3xl font-bold tracking-wide">GRAHA</h1>
            </div>
            <p class="text-blue-200 text-sm font-medium tracking-wider uppercase">Platform Aplikasi Kos Terintegrasi</p>
        </div>

        <div class="p-12 relative z-10">
            <h2 class="text-4xl font-bold text-white leading-tight mb-6">Manajemen kos cerdas,<br><span class="text-teal-400">transparan</span> & <span class="text-teal-400">terintegrasi.</span></h2>
            <p class="text-blue-100/80 text-lg max-w-md leading-relaxed mb-8">Jembatan interaksi digital antara pencari kos dan pemilik properti. Temukan hunian nyaman atau kelola aset Anda dengan fitur tagihan pintar.</p>
            <ul class="space-y-4 text-blue-100/90 text-sm font-medium">
                <li class="flex items-center"><i class="fa-solid fa-circle-check text-teal-400 mr-3"></i> Eksplorasi hunian dengan mudah</li>
                <li class="flex items-center"><i class="fa-solid fa-circle-check text-teal-400 mr-3"></i> Billing system terpisah (Sewa & Utilitas)</li>
                <li class="flex items-center"><i class="fa-solid fa-circle-check text-teal-400 mr-3"></i> Penanganan keluhan cepat & terpusat</li>
            </ul>
        </div>
    </div>

    <!-- RIGHT PANEL: Authentication Forms -->
    <div class="w-full md:w-1/2 h-full bg-white flex flex-col justify-center px-8 sm:px-16 lg:px-24 overflow-y-auto relative">
        
        <!-- Flash Messages (Notifikasi Error/Sukses) -->
        @if(session('success'))
            <div class="mb-4 bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="md:hidden flex items-center justify-center text-[#1E3A8A] mb-8 mt-8">
            <img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="h-10 w-auto mr-3">
            <h1 class="text-3xl font-bold tracking-wide">GRAHA</h1>
        </div>

        <!-- ================= LOGIN SECTION ================= -->
        <div id="login-section" class="w-full max-w-md mx-auto fade-in block pb-12 md:pb-0">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-[#1E3A8A] mb-2">Selamat Datang 👋</h2>
                <p class="text-gray-500">Masuk untuk mengelola properti atau mencari hunian idaman Anda.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-[#1E3A8A] mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" name="email" class="form-input" placeholder="contoh@email.com" required>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-[#1E3A8A]">Password</label>
                    </div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="login-password" class="form-input" placeholder="••••••••" required>
                        <button type="button" id="toggle-login-pwd" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1E3A8A]">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500 cursor-pointer">
                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="w-full bg-[#1E3A8A] text-white font-bold py-3.5 rounded-xl hover:bg-blue-900 shadow-lg shadow-[#1E3A8A]/30 transition transform hover:-translate-y-0.5 mt-4">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Belum memiliki akun? 
                    <button id="show-register" class="text-teal-600 font-bold hover:underline">Daftar Sekarang</button>
                </p>
            </div>
        </div>

        <!-- ================= REGISTER SECTION ================= -->
        <div id="register-section" class="w-full max-w-md mx-auto fade-in hidden pb-12 md:pb-0">
            <div class="mb-8">
                <button id="show-login" class="text-gray-400 hover:text-[#1E3A8A] mb-4 inline-flex items-center transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </button>
                <h2 class="text-3xl font-bold text-[#1E3A8A] mb-2">Buat Akun Baru 🚀</h2>
                <p class="text-gray-500">Pilih peran Anda dan mulai pengalaman digitalisasi kos bersama GRAHA.</p>
            </div>

            <form action="{{ url('/register') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Role Selection -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-[#1E3A8A]">Daftar Sebagai:</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="role" value="pencari" class="role-radio peer sr-only" checked>
                            <div class="border-2 border-gray-200 rounded-xl p-4 transition-all hover:border-teal-300 flex flex-col items-center text-center h-full">
                                <div class="role-icon w-12 h-12 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xl mb-3 transition-colors">
                                    <i class="fa-solid fa-magnifying-glass-location"></i>
                                </div>
                                <span class="font-bold text-[#1E3A8A] text-sm mb-1">Pencari Kos</span>
                                <span class="text-xs text-gray-500">Cari kamar & bayar sewa</span>
                                <div class="role-check absolute top-3 right-3 text-teal-600 opacity-0 transform scale-50 transition-all"><i class="fa-solid fa-circle-check text-lg"></i></div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="role" value="tuan_kos" class="role-radio peer sr-only">
                            <div class="border-2 border-gray-200 rounded-xl p-4 transition-all hover:border-teal-300 flex flex-col items-center text-center h-full">
                                <div class="role-icon w-12 h-12 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xl mb-3 transition-colors">
                                    <i class="fa-solid fa-building-user"></i>
                                </div>
                                <span class="font-bold text-[#1E3A8A] text-sm mb-1">Pemilik Kos</span>
                                <span class="text-xs text-gray-500">Kelola properti & tagihan</span>
                                <div class="role-check absolute top-3 right-3 text-teal-600 opacity-0 transform scale-50 transition-all"><i class="fa-solid fa-circle-check text-lg"></i></div>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="admin-disclaimer" class="hidden bg-blue-50 border border-blue-100 rounded-lg p-3 text-xs text-[#1E3A8A] font-medium flex items-start">
                    <i class="fa-solid fa-circle-info text-blue-500 mt-0.5 mr-2"></i>
                    <span>Sesuai kebijakan sistem, pendaftaran sebagai <strong>Pemilik Kos</strong> akan melalui proses verifikasi oleh Admin sebelum Anda dapat mendaftarkan properti.</span>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#1E3A8A] mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa-regular fa-user"></i></span>
                        <input type="text" name="name" class="form-input" placeholder="Masukkan nama Anda" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#1E3A8A] mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" name="email" class="form-input" placeholder="contoh@email.com" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#1E3A8A] mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="reg-password" class="form-input" placeholder="Buat kata sandi yang kuat" required minlength="8">
                        <button type="button" id="toggle-reg-pwd" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1E3A8A]">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Konfirmasi Password (Wajib untuk validasi Laravel) -->
                <div>
                    <label class="block text-sm font-semibold text-[#1E3A8A] mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Ketik ulang kata sandi" required minlength="8">
                    </div>
                </div>

                <button type="submit" class="w-full bg-teal-600 text-white font-bold py-3.5 rounded-xl hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition transform hover:-translate-y-0.5 mt-4">
                    Buat Akun
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Sudah memiliki akun? 
                    <button id="show-login-btn" class="text-[#1E3A8A] font-bold hover:underline">Masuk di sini</button>
                </p>
            </div>
        </div>

    </div>

    <!-- LOGIKA JQUERY -->
    <script>
        $(document).ready(function() {
            // Toggles Tampilan Login & Register
            $('#show-register').click(function() {
                $('#login-section').addClass('hidden');
                $('#register-section').removeClass('hidden');
            });
            $('#show-login, #show-login-btn').click(function() {
                $('#register-section').addClass('hidden');
                $('#login-section').removeClass('hidden');
            });

            // Logika Tampil Disclaimer Pemilik Kos
            $('input[name="role"]').change(function() {
                if($(this).val() === 'tuan_kos') {
                    $('#admin-disclaimer').removeClass('hidden').addClass('fade-in');
                } else {
                    $('#admin-disclaimer').addClass('hidden').removeClass('fade-in');
                }
            });

            // Toggle Show/Hide Password
            function togglePassword(inputId, btnId) {
                $(btnId).click(function() {
                    let input = $(inputId);
                    let icon = $(this).find('i');
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        input.attr('type', 'password');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });
            }
            togglePassword('#login-password', '#toggle-login-pwd');
            togglePassword('#reg-password', '#toggle-reg-pwd');
        });
    </script>
</body>
</html>