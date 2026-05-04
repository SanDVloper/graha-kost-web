<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GRAHA - Management Kos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        
        <button id="toggle-sidebar" class="absolute -right-3.5 top-1/2 -translate-y-1/2 bg-white border border-gray-200 rounded-full w-7 h-7 flex items-center justify-center text-gray-500 hover:text-teal-600 hover:bg-teal-50 shadow-md transition-transform duration-300 z-50">
            <i class="fa-solid fa-chevron-left text-xs"></i>
        </button>

        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden whitespace-nowrap">
            <div class="mr-3 shrink-0 flex items-center justify-center w-10">
                <img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="w-full h-auto drop-shadow-sm">
            </div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl text-slate-800 tracking-wide">GRAHA</h1>
                <p class="text-[0.6rem] text-teal-600 font-semibold uppercase tracking-wider">Slogan Slogan Slogan</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto overflow-x-hidden">
            <a href="{{ url('/') }}" class="flex items-center px-4 py-3 bg-teal-50 text-teal-600 rounded-lg mb-6 whitespace-nowrap">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3 sidebar-text">Dashboard Utama</span>
            </a>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4 sidebar-text whitespace-nowrap">System</div>
            
            <a href="{{ route('settings.global') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-teal-600 rounded-lg transition-colors whitespace-nowrap">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="ml-3 sidebar-text">Settings</span>
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
            <div class="flex items-center text-slate-700 font-semibold">
                <i class="fa-regular fa-calendar text-xl mr-3"></i>
                <span class="text-lg">{{ date('l, d F Y') }}</span>
            </div>

            <div class="flex items-center space-x-6">
                <button class="text-gray-400 hover:text-teal-600 transition-colors relative">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-teal-500 rounded-full border border-white"></span>
                </button>
                
                <div class="flex items-center cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-teal-200 text-teal-700 flex items-center justify-center font-bold mr-3 uppercase drop-shadow-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="flex flex-col mr-2">
                        <span class="font-bold text-slate-800 text-sm">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-teal-600 font-medium">
                            {{ auth()->user()->role == 'tuan_kos' ? 'Pemilik Kos' : 'Pencari Kos' }}
                        </span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 ml-2"></i>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-2">Welcome to GRAHA!</h2>
                    <p class="text-gray-500 text-lg">Your integrated boarding house management system is ready.</p>
                </div>
                
                @if(!$properties->isEmpty() && auth()->user()->role == 'tuan_kos')
                <a href="{{ url('/add-property') }}" class="bg-[#38a38e] hover:bg-teal-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition-all flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Add Property
                </a>
                @endif
            </div>

            @if($properties->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-200 p-12 flex flex-col items-center justify-center shadow-sm mb-10 text-center">
                    <div class="text-[#38a38e] text-8xl mb-6">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">YOU DON'T HAVE A PROPERTY YET!</h3>
                    <p class="text-gray-500 text-lg max-w-2xl mb-8 leading-relaxed">
                        Your digital storefront and management system are still empty. Add your boarding house details, room types, and pricing plans to start accepting new residents.
                    </p>
                    <a href="{{ url('/add-property') }}" class="inline-block bg-[#38a38e] hover:bg-teal-700 text-white font-bold text-lg py-3 px-8 rounded-lg shadow-[0_4px_14px_0_rgba(56,163,142,0.39)] transition-all transform hover:-translate-y-0.5 text-center">
                        Add Property
                    </a>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Get Started in 3 Easy Steps</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl border border-gray-200 p-8 flex flex-col items-center text-center shadow-sm">
                            <div class="text-[#1e3a5f] text-8xl mb-6"><i class="fa-solid fa-house-medical"></i></div>
                            <h4 class="font-bold text-xl text-slate-800 mb-2">1. Property Profile</h4>
                            <p class="text-gray-500 text-sm">Fill in the name of the boarding house, address, and upload photos.</p>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 p-8 flex flex-col items-center text-center shadow-sm">
                            <div class="text-[#1e3a5f] text-8xl mb-6"><i class="fa-solid fa-circle-user"></i></div>
                            <h4 class="font-bold text-xl text-slate-800 mb-2">2. Room Type & Price</h4>
                            <p class="text-gray-500 text-sm">Set room variations, rental prices, and available facilities.</p>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 p-8 flex flex-col items-center text-center shadow-sm">
                            <div class="text-[#1e3a5f] text-8xl mb-6"><i class="fa-solid fa-computer"></i></div>
                            <h4 class="font-bold text-xl text-slate-800 mb-2">3. Publikasi & Kelola</h4>
                            <p class="text-gray-500 text-sm">Your boarding house is ready to be published and managed digitally.</p>
                        </div>
                    </div>
                </div>
            @else
                <h3 class="text-xl font-bold text-slate-800 mb-4 border-b border-gray-200 pb-2">Properti Saya</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties as $property)
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col">
                            
                            <div class="h-40 bg-gray-200 relative group">
                                @php
                                    $coverImage = !empty($property->photos) && isset($property->photos[0]) 
                                        ? asset('storage/' . $property->photos[0]) 
                                        : 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
                                @endphp
                                <img src="{{ $coverImage }}" alt="Kos" class="w-full h-full object-cover">
                                
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-bold text-[#1e3a5f] shadow-sm">
                                    {{ ucfirst($property->type) }}
                                </div>
                            </div>
                            
                            <div class="p-5 flex-1 flex flex-col">
                                <h4 class="text-lg font-bold text-[#1e3a5f] mb-1 truncate" title="{{ $property->name }}">{{ $property->name }}</h4>
                                <p class="text-sm text-gray-500 mb-4 flex-1 line-clamp-2">{{ $property->description ?? 'Tidak ada deskripsi.' }}</p>
                                
                                <div class="flex items-center justify-between text-sm text-gray-600 mb-4 bg-gray-50 p-2.5 rounded-lg border border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <span class="font-bold text-[#38a38e]">{{ $property->rooms->count() }}</span>
                                        <span class="text-xs">Tipe Kamar</span>
                                    </div>
                                    <div class="h-8 w-px bg-gray-200"></div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-bold text-[#38a38e]">{{ $property->rooms->sum('quantity') }}</span>
                                        <span class="text-xs">Total Unit</span>
                                    </div>
                                    <div class="h-8 w-px bg-gray-200"></div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-bold text-yellow-500"><i class="fa-solid fa-star text-[10px]"></i> Baru</span>
                                        <span class="text-xs">Status</span>
                                    </div>
                                </div>

                                <a href="{{ route('property.manage', $property->id) }}" class="block text-center w-full py-2 bg-slate-100 hover:bg-[#38a38e] text-slate-700 hover:text-white font-semibold rounded-lg transition-colors border border-gray-200 hover:border-transparent text-sm">
                                    Kelola Properti <i class="fa-solid fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </main>

    <script type="module">
        $(document).ready(function() {
            let isSidebarOpen = true;

            $('#toggle-sidebar').click(function() {
                isSidebarOpen = !isSidebarOpen;

                if (isSidebarOpen) {
                    $('#sidebar').removeClass('w-20').addClass('w-64');
                    setTimeout(() => {
                        $('.sidebar-text').fadeIn(200); 
                    }, 150); 
                    $(this).css('transform', 'translateY(-50%) rotate(0deg)');
                } else {
                    $('.sidebar-text').hide();
                    $('#sidebar').removeClass('w-64').addClass('w-20');
                    $(this).css('transform', 'translateY(-50%) rotate(180deg)');
                }
            });
        });
    </script>
</body>
</html>