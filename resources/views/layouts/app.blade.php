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

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#1E3A8A] flex items-center">
                <i class="fa-solid fa-house-chimney text-teal-500 mr-2"></i>GRAHA
            </a>

            <div class="flex items-center gap-6">
                <a href="{{ route('customer.index') }}" class="text-gray-600 hover:text-teal-600 font-bold transition">Cari Kos</a>

                @guest
                    <a href="{{ route('login') }}" class="bg-teal-50 text-teal-700 px-6 py-2 rounded-xl font-bold hover:bg-teal-100 transition border border-teal-100">Masuk</a>
                @else

                    @if(Auth::user()->role == 'penghuni')
                        <a href="{{ route('customer.billing') }}" class="text-gray-600 hover:text-teal-600 font-bold transition flex items-center">
                            <i class="fa-solid fa-wallet mr-1.5 text-sm"></i> Billing
                        </a>

                        <a href="{{ route('customer.complain.view') }}" class="text-gray-600 hover:text-teal-600 font-bold transition flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1.5 text-sm"></i> Komplain
                        </a>

                    @else
                        <button type="button" onclick="bukaModalNotifikasi()" class="text-gray-600 hover:text-blue-600 font-bold transition flex items-center relative py-1">
                            <i class="fa-solid fa-bell text-lg"></i>
                            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white animate-ping"></span>
                            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                    @endif

                    <span class="text-gray-800 font-medium border-l pl-4 border-gray-200">Halo, {{ Auth::user()->name }}!</span>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    @auth
        <div id="modal-notifikasi-acc" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 flex">
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
                        Selamat! Pengajuan sewa Anda untuk <strong>Kos Graha Dewata</strong> telah disetujui oleh pemilik kos. Silakan masuk ke halaman kos sewaan Anda untuk mengelola hunian secara penuh.
                    </p>
                </div>

                <button type="button" onclick="masukHalamanKosSewa()" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3.5 rounded-xl text-xs transition shadow-md flex items-center justify-center gap-1.5 active:scale-95 animate-pulse">
                    <i class="fa-solid fa-building-user"></i> Masuk ke Halaman Kos Saya
                </button>
            </div>
        </div>

        <script>
            function bukaModalNotifikasi() {
                document.getElementById('modal-notifikasi-acc').classList.remove('hidden');
            }
            function tutupModalNotifikasi() {
                document.getElementById('modal-notifikasi-acc').classList.add('hidden');
            }

            // 🟢 EDIT: Mengubah fungsi redirect agar mengarah ke halaman khusus kos sewaan miliknya
            function masukHalamanKosSewa() {
                tutupModalNotifikasi();
                alert('Simulasi Sukses!\nStatus Anda kini aktif sebagai "Penghuni Kos". Menu Billing & Komplain otomatis tersedia di dalam halaman hunian Anda!');

                // Dialihkan ke rute halaman khusus kos yang disewa sesuai skenariomu
                window.location.href = "/kos-saya";
            }
        </script>
    @endauth

    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div class="container mx-auto px-6 text-center text-gray-400 text-sm">
            <p>&copy; 2026 GRAHA - Manajemen Kos Modern. Dibuat dengan <i class="fa-solid fa-heart text-red-500 mx-1"></i> oleh Tuanku.</p>
        </div>
    </footer>

</body>
</html>
