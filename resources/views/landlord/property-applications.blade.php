<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Masuk - {{ $property->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR KHUSUS MANAJEMEN PROPERTI -->
    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden">
            <div class="mr-3 shrink-0 w-10"><img src="{{ asset('assets/logograha.png') }}" class="w-full h-auto"></div>
            <div class="sidebar-text"><h1 class="font-bold text-xl">GRAHA</h1></div>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ url('/') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mb-4">
                <i class="fa-solid fa-arrow-left w-6 text-cente+r"></i><span class="ml-3 sidebar-text">Dashboard Utama</span>
            </a>
            
            <div class="text-xs font-bold text-gray-400 uppercase px-4 mb-2 mt-4 truncate">{{ $property->name }}</div>
            
            <a href="{{ route('property.manage', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg">
                <i class="fa-solid fa-chart-line w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Overview</span>
            </a>
            
            <a href="{{ route('property.rooms', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-solid fa-house-user w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Kamar & Fasilitas</span>
            </a>
            
            <a href="{{ route('property.occupants', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-solid fa-users w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Penghuni (Occupant)</span>
            </a>

            <a href="{{ route('property.billing', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-regular fa-credit-card w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Tagihan & Sewa</span>
            </a>

            <a href="{{ route('property.complains', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-regular fa-envelope w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Keluhan</span>
            </a>

            <a href="{{ route('property.applications', $property->id) }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg mt-1">
                <i class="fa-solid fa-bell w-6 text-center"></i><span class="ml-3 sidebar-text font-bold">Pengajuan Masuk</span>
            </a>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4 sidebar-text whitespace-nowrap">System</div>
            
            <!-- Menu Pengaturan -->
            <a href="{{ route('property.settings', $property->id) }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg mt-1">
                <i class="fa-solid fa-gear w-6 text-center"></i><span class="ml-3 sidebar-text font-medium">Pengaturan Kos</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-bell mr-3 text-[#38a38e]"></i> Pengajuan Masuk
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 max-w-5xl mx-auto w-full">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">
                @if($applications->isEmpty())
                    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center shadow-sm">
                        <i class="fa-solid fa-inbox text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-bold text-gray-700">Belum Ada Pengajuan Masuk</h3>
                        <p class="text-gray-500 mt-2">Saat ini belum ada calon penghuni yang mengajukan sewa di properti ini.</p>
                    </div>
                @else
                    @foreach($applications as $app)
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm flex flex-col md:flex-row justify-between gap-6 transition-all hover:shadow-md">
                        <!-- Tenant Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-xl">
                                    {{ substr($app->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-800">{{ $app->user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $app->user->email }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-y-3 text-sm">
                                <div>
                                    <span class="text-gray-400 block text-xs font-semibold uppercase">No. WhatsApp</span>
                                    <span class="font-medium text-slate-700">{{ $app->user->phone_number ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block text-xs font-semibold uppercase">Jenis Kelamin</span>
                                    <span class="font-medium text-slate-700">{{ $app->user->gender ?? '-' }}</span>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-gray-400 block text-xs font-semibold uppercase">Pekerjaan / Instansi</span>
                                    <span class="font-medium text-slate-700">{{ $app->user->pekerjaan ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Rent & Action -->
                        <div class="w-full md:w-64 border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6 flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase block mb-1">Tagihan Awal</span>
                                <h3 class="text-xl font-black text-[#1e3a5f]">Rp {{ number_format($app->amount, 0, ',', '.') }}</h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fa-regular fa-clock"></i> Diajukan {{ $app->created_at->diffForHumans() }}
                                </p>
                            </div>
                            
                            <div class="flex gap-2 mt-6">
                                <form action="{{ route('property.applications.accept', [$property->id, $app->id]) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full py-2 bg-[#38a38e] hover:bg-teal-700 text-white font-bold rounded-lg transition-colors text-sm">
                                        <i class="fa-solid fa-check mr-1"></i> Terima
                                    </button>
                                </form>
                                <form action="{{ route('property.applications.reject', [$property->id, $app->id]) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full py-2 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white font-bold border border-red-200 hover:border-red-500 rounded-lg transition-colors text-sm">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

        </div>
    </main>

</body>
</html>