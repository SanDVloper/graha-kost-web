@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    <!-- BAGIAN 1: HERO HEADER -->
    <div class="bg-[#1E3A8A] pt-16 pb-24 px-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-teal-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Temukan Hunian Nyamanmu</h1>
            <p class="text-blue-100 opacity-80 max-w-2xl mx-auto">
                Satu platform untuk semua kebutuhan kosmu. Mulai dari pencarian, booking, hingga pembayaran tagihan.
            </p>
        </div>
    </div>

    <!-- BAGIAN 2: FILTER BAR (Pusat Kendali Pencarian) -->
    <div class="container mx-auto px-6 -mt-10 relative z-20">
        <!-- RUTE DIUBAH KE customer.index -->
        <form action="{{ route('customer.index') }}" method="GET" class="bg-white p-5 rounded-2xl shadow-xl flex flex-wrap gap-4 items-center border border-gray-100">

            <div class="flex-1 min-w-[280px] relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari lokasi atau nama kos..."
                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all">
            </div>

            <div class="min-w-[150px]">
                <select name="kategori" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all text-gray-600">
                    <option value="">Semua Tipe</option>
                    <option value="putra" {{ request('kategori') == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ request('kategori') == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campur" {{ request('kategori') == 'campur' ? 'selected' : '' }}>Campur</option>
                </select>
            </div>

            <div class="min-w-[180px]">
                <input type="number" name="harga_max" value="{{ request('harga_max') }}"
                    placeholder="Harga Maksimal"
                    class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all">
            </div>

            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-10 py-3.5 rounded-xl font-bold transition-all shadow-lg shadow-teal-600/30 transform hover:-translate-y-0.5">
                Cari Sekarang
            </button>
        </form>
    </div>

    <!-- BAGIAN 3: GRID HASIL PENCARIAN -->
    <div class="container mx-auto px-6 mt-16">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[#1E3A8A]">Pilihan Kos Untukmu</h2>
                <p class="text-gray-500 text-sm">Menampilkan hasil pencarian terbaik di sekitar lokasi.</p>
            </div>
            <div class="bg-blue-50 px-4 py-2 rounded-lg text-[#1E3A8A] text-sm font-bold border border-blue-100">
                <!-- VARIABEL DIUBAH KE $properties -->
                Total: {{ $properties->count() }} Properti ditemukan
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- LOOPING MENGGUNAKAN $properties -->
            @forelse($properties as $item)
    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 group flex flex-col">

        <div class="relative h-56 overflow-hidden bg-gray-200 shrink-0">
            @php
                // Jika kolom photos di database kosong atau default, gunakan gambar lokal dari folder public/images/
                // Format file: kos1.jpg, kos2.jpg, dst menyesuaikan ID kosan
                $fotoUtama = asset('image/kos' . $item->id . '.jpg');

                // Backup jika kamu belum memindahkan foto asli ke folder public
                // $fotoUtama = 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=500&q=80';
            @endphp
            <img src="{{ $fotoUtama }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" onerror="this.src='https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=500&q=80'">

            <div class="absolute top-4 left-4">
                <span class="bg-white/90 backdrop-blur px-3 py-1.5 rounded-full text-[10px] font-black text-teal-700 uppercase tracking-widest shadow-sm">
                    Kos {{ ucfirst($item->type ?? 'Umum') }}
                </span>
            </div>
        </div>

        <div class="p-7 flex-1 flex flex-col">
            <div class="flex justify-between items-start mb-2">
                <h3 class="font-bold text-xl text-gray-800 leading-tight group-hover:text-teal-600 transition-colors">{{ $item->name }}</h3>
            </div>

            <p class="text-gray-500 text-sm mb-4 flex items-center line-clamp-1">
                <i class="fa-solid fa-location-dot mr-2 text-red-400"></i>
                @php
                    preg_match('#\((.*?)\)#', $item->name, $match);
                    echo $match[1] ?? 'Bali';
                @endphp
            </p>

            <div class="flex gap-3 mb-6">
                <span class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 text-xs" title="WiFi"><i class="fa-solid fa-wifi"></i></span>
                <span class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 text-xs" title="Kamar Mandi"><i class="fa-solid fa-bath"></i></span>
                <span class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 text-xs" title="Kasur"><i class="fa-solid fa-bed"></i></span>
            </div>

            <div class="flex justify-between items-end pt-5 border-t border-gray-50 mt-auto">
                <div>
                    <span class="block text-xs text-gray-400 uppercase font-bold tracking-tighter mb-1">Mulai Dari</span>
                    <span class="text-teal-600 font-extrabold text-xl">
                        @php
                            // Logika penentu harga berdasarkan fasilitas kosan Bali
                            $hargaTampil = 600000;
                            if($item->type == 'putri') $hargaTampil = 850000;
                            if($item->type == 'putra') $hargaTampil = 750000;
                            if(str_contains(strtolower($item->name), 'premium') || str_contains(strtolower($item->name), 'luxury')) {
                                $hargaTampil = 1800000;
                            } elseif($item->type == 'campur' && $hargaTampil == 600000) {
                                $hargaTampil = 1200000;
                            }
                        @endphp
                        Rp {{ number_format($hargaTampil, 0, ',', '.') }}
                    </span>
                    <span class="text-gray-400 text-xs">/bln</span>
                </div>

                <a href="{{ route('customer.show', $item->id) }}" class="bg-[#1E3A8A] text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-900 transition-all shadow-md">
                    Lihat Detail
                </a>
            </div>
        </div>

    </div>
@empty
    <div class="col-span-full bg-white rounded-3xl p-20 text-center border-2 border-dashed border-gray-100">
        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-house-circle-exclamation text-3xl text-gray-300"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Kos Tidak Ditemukan</h3>
        <p class="text-gray-400 max-w-sm mx-auto">Coba gunakan kata kunci lain atau ubah filter tipe untuk menemukan hunian Bali yang pas.</p>
        <a href="{{ route('customer.index') }}" class="mt-6 inline-block text-teal-600 font-bold hover:underline">Reset Semua Filter</a>
    </div>
@endforelse
                </div>
            </div>

            <!-- BAGIAN 4: NAVIGASI PAGINATION -->
            <div class="container mx-auto px-6 mt-16 flex justify-center">
                @if($properties instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $properties->appends(request()->query())->links() }}
                @endif
            </div>
        </div>
        @endsection
