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
                    <a href="{{ route('customer.billing') }}" class="text-gray-600 hover:text-teal-600 font-bold transition flex items-center">
                        <i class="fa-solid fa-wallet mr-1.5 text-sm"></i> Billing
                    </a>

                    <a href="{{ route('customer.complain.view') }}" class="text-gray-600 hover:text-teal-600 font-bold transition flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-1.5 text-sm"></i> Komplain
                    </a>

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

    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div class="container mx-auto px-6 text-center text-gray-400 text-sm">
            <p>&copy; 2026 GRAHA - Manajemen Kos Modern. Dibuat dengan <i class="fa-solid fa-heart text-red-500 mx-1"></i> oleh Tuanku.</p>
        </div>
    </footer>

</body>
</html>
