<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRAHA - Sistem Manajemen Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    <!-- ==================== NAVIGATION BAR ATAS ==================== -->
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#1E3A8A] flex items-center">
                <i class="fa-solid fa-house-chimney text-teal-500 mr-2"></i>GRAHA
            </a>

            <div class="flex items-center gap-6">
                <a href="{{ route('customer.index') }}" class="text-gray-600 hover:text-teal-600 font-bold transition">Cari Kos</a>

                <!-- 🔐 KONDISI A: JIKA SUDAH LOGIN (AKUN SUDAH TERTAUT) -->
                @if(Auth::check())

                    <!-- Jika user berada di halaman kos-saya, munculkan menu khusus Penghuni -->
                    @if(Request::is('kos-saya*'))
                        @if(Auth::user()->role == 'penghuni')
                            <a href="{{ route('customer.billing') }}" class="text-gray-600 hover:text-teal-600 font-bold transition flex items-center">
                                <i class="fa-solid fa-wallet mr-1.5 text-sm"></i> Billing
                            </a>
                            <a href="{{ route('customer.complain.view') }}" class="text-gray-600 hover:text-teal-600 font-bold transition flex items-center">
                                <i class="fa-solid fa-circle-exclamation mr-1.5 text-sm"></i> Komplain
                            </a>
                        @endif
                    @else
                        <!-- 🏠 Jika masih di halaman Cari Kos tapi SUDAH login, munculkan tombol akses ke Kos Saya -->
                        <a href="{{ route('customer.myKos') }}" class="bg-[#1E3A8A] text-white px-4 py-2 rounded-xl text-xs font-black hover:bg-blue-900 transition flex items-center gap-1 shadow-sm">
                            <i class="fa-solid fa-house-user"></i> Halaman Kos Saya
                        </a>
                    @endif

                    <!-- Identitas Akun Terdaftar (Nama Dinamis) -->
                    <span class="text-gray-800 font-medium border-l pl-4 border-gray-200">Halo, {{ Auth::user()->name }}!</span>

                    <!-- Form Logout Resmi -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition text-xs">Logout</button>
                    </form>

                @else
                    <!-- 🔓 KONDISI B: JIKA BELUM LOGIN (GUEST / AKUN BELUM TERTAUT) -->
                    <a href="{{ route('login') }}" class="bg-teal-50 text-teal-700 px-6 py-2 rounded-xl font-bold hover:bg-teal-100 transition border border-teal-100 flex items-center gap-1.5 text-xs">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk / Daftar
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- ==================== KONTEN UTAMA HALAMAN BERSANGKUTAN ==================== -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ==================== MODAL NOTIFIKASI ACC ==================== -->
    @auth
        <div id="modal-notifikasi-acc" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
            <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center shadow-2xl border border-gray-100 relative">
                <button onclick="tutupModalNotifikasi()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark"></i></button>

                <h3 class="text-base font-extrabold text-gray-800 text-left mb-4 flex items-center border-b pb-2">
                    <i class="fa-solid fa-bell text-blue-500 mr-2"></i> Notifikasi Sistem
                </h3>

                <div class="bg-green-50 border border-green-100 p-4 rounded-2xl text-left space-y-3 mb-5">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-emerald-800">Pengajuan Di-ACC!</span>
                        <span class="bg-emerald-500 text-white font-black text-[9px] px-1.5 py-0.5 rounded-md uppercase tracking-wider">Approved</span>
                    </div>
                    <p class="text-[11px] text-emerald-700 leading-relaxed">
                        Selamat! Pengajuan sewa Anda telah disetujui oleh pemilik kos. Silakan selesaikan pembayaran terlebih dahulu untuk masuk ke halaman kos sewaan Anda secara penuh.
                    </p>
                </div>

                <a href="{{ route('customer.billing') }}" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3.5 rounded-xl text-xs transition shadow-md flex items-center justify-center gap-1.5 active:scale-95 animate-pulse">
                    <i class="fa-solid fa-credit-card"></i> Selesaikan Pembayaran Tagihan
                </a>
            </div>
        </div>
    @endauth

    <!-- ==================== FOOTER KAKI HALAMAN ==================== -->
    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div class="container mx-auto px-6 text-center text-gray-400 text-sm">
            <p>&copy; 2026 GRAHA - Manajemen Kos Modern. Dibuat dengan <i class="fa-solid fa-heart text-red-500 mx-1"></i> oleh Tuanku.</p>
        </div>
    </footer>

    <!-- ==================== JAVASCRIPT LOGIC INTERACTION ==================== -->
    <script>
        function bukaModalNotifikasi() {
            var modal = document.getElementById('modal-notifikasi-acc');
            if(modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }
        function tutupModalNotifikasi() {
            var modal = document.getElementById('modal-notifikasi-acc');
            if(modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>

    @auth
        @php
            // Cek apakah ada tagihan unpaid dan role pencari untuk memunculkan notifikasi otomatis
            $showNotif = false;
            if (Auth::user()->role === 'pencari') {
                $showNotif = \App\Models\Billing::where('user_id', Auth::id())
                    ->where('status', 'unpaid')
                    ->exists();
            }
        @endphp

        @if($showNotif)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                bukaModalNotifikasi();
            });
        </script>
        @endif
    @endauth

</body>
</html>
