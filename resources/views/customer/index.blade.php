@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">

    <!-- Hero Section -->
    <div class="bg-[#1E3A8A] text-white py-16 px-6 text-center relative overflow-hidden">
        <div class="max-w-3xl mx-auto relative z-10 space-y-4">
            <h1 class="text-3xl md:text-5xl font-black tracking-tight">Cari Kos Modern di Bali Jadi Lebih Mudah</h1>
            <p class="text-blue-100 text-sm md:text-base">Temukan hunian kos terbaik dengan fasilitas lengkap, transparan, dan sistem terintegrasi.</p>

            <form action="{{ route('customer.index') }}" method="GET" class="bg-white p-3 rounded-2xl shadow-xl max-w-2xl mx-auto flex flex-col md:flex-row gap-3 mt-8">
                <div class="flex-1 flex items-center px-3 bg-gray-50 rounded-xl border">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 mr-2"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan nama kos atau wilayah..." class="w-full py-2.5 bg-transparent text-gray-700 text-xs font-semibold outline-none">
                </div>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-3 rounded-xl text-xs transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari Hunian
                </button>
            </form>
        </div>
        <div class="absolute -top-10 -left-10 w-40 h-44 bg-blue-700 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-10 -right-10 w-40 h-44 bg-teal-500 rounded-full blur-3xl opacity-30"></div>
    </div>

    <!-- Katalog Konten Utama -->
    <div class="container mx-auto px-6 mt-12">

        <!-- 📝 DATA PANEL KENDALI AKSES SUDAH DIHAPUS AGAR HANYA ADA 1 OPSI LOGIN DI NAVBAR ATAS -->

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-wide">Rekomendasi Kos Terpopuler</h2>
                <p class="text-xs text-gray-400 font-medium">Jelajahi kos terbaik yang siap kamu huni sekarang.</p>
            </div>
            <span class="text-xs font-bold text-teal-600 bg-teal-50 px-3 py-1.5 rounded-full border border-teal-100 hidden sm:block">
                Total: {{ count($properties ?? []) }} Properti Tersedia
            </span>
        </div>

        <!-- Grid Cards Properti Kos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($properties ?? [] as $property)
                @php
                    // Hitung harga termurah dan sisa kamar secara dinamis
                    $hargaTampil = $property->rooms->min('price_monthly') ?? 600000;
                    $sisaKamar = $property->rooms->sum('quantity'); // Di masa depan bisa dikurangi dengan tagihan aktif
                    
                    $fotoKos = asset('image/kos' . $property->id . '.jpg');
                @endphp

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md hover:border-teal-100 transition-all flex flex-col group">
                    <div class="relative h-48 w-full bg-gray-200 overflow-hidden">
                        <img src="{{ $fotoKos }}" alt="{{ $property->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=600&q=50'">

                        <span class="absolute top-4 left-4 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm
                            {{ $property->type == 'putri' ? 'bg-pink-500 text-white' : ($property->type == 'putra' ? 'bg-blue-600 text-white' : 'bg-purple-600 text-white') }}">
                            Kos {{ ucfirst($property->type ?? 'Campur') }}
                        </span>

                        @if($sisaKamar > 0)
                            <span class="absolute bottom-4 right-4 bg-emerald-500/90 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded-md">
                                Sisa {{ $sisaKamar }} Kamar
                            </span>
                        @else
                            <span class="absolute bottom-4 right-4 bg-red-500/90 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded-md">
                                Kamar Penuh
                            </span>
                        @endif
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <h3 class="font-extrabold text-gray-800 text-base leading-snug group-hover:text-[#1E3A8A] transition-colors">{{ $property->name }}</h3>
                            <p class="text-gray-400 text-xs flex items-center font-medium">
                                <i class="fa-solid fa-location-dot mr-1.5 text-red-400 text-sm"></i>
                                @php
                                    preg_match('#\((.*?)\)#', $property->name, $match);
                                    $wilayah = $match[1] ?? ($property->location ?? ($property->address ?? 'Bali'));
                                @endphp
                                {{ $wilayah }}
                            </p>
                        </div>

                        <div class="border-t border-b border-gray-50 py-3 flex justify-between items-center">
                            <div>
                                <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider">Harga Sewa</span>
                                <strong class="text-lg font-black text-teal-600">Rp {{ number_format($hargaTampil, 0, ',', '.') }}</strong>
                                <span class="text-[10px] text-gray-400 font-bold">/ bulan</span>
                            </div>

                            <button type="button" onclick="bukaModalDenah('{{ $property->name }}', '{{ $property->id }}')" class="bg-gray-50 hover:bg-gray-100 text-gray-600 border border-gray-200 text-[11px] font-bold px-3 py-2 rounded-xl transition flex items-center gap-1">
                                <i class="fa-solid fa-map-location-dot text-teal-500"></i> Lihat Denah
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <a href="{{ route('customer.show', $property->id) }}" class="col-span-2 bg-[#1E3A8A] hover:bg-blue-900 text-white text-center font-bold py-2.5 rounded-xl text-xs transition shadow-md flex items-center justify-center gap-1">
                                <i class="fa-solid fa-circle-info"></i> Lihat Detail Kamar & Fasilitas
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white border rounded-3xl p-12 text-center text-gray-400 font-medium">
                    <i class="fa-solid fa-house-crack text-5xl mb-3 text-gray-200"></i>
                    <p>Maaf, data properti kos belum tersedia atau gagal dimuat.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Denah -->
<div id="modal-denah-publik" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity flex">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full text-center shadow-2xl border border-gray-100 my-auto">
        <div class="flex justify-between items-center mb-4 pb-2 border-b">
            <span class="text-xs font-black text-[#1E3A8A] flex items-center uppercase tracking-wider">
                <i class="fa-solid fa-vector-square mr-2 text-teal-500 text-sm"></i> Denah Layout Kamar
            </span>
            <button onclick="tutupModalDenah()" class="text-gray-400 hover:text-gray-600 text-sm"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <h4 id="modal-denah-title" class="font-extrabold text-gray-800 text-sm text-left mb-3">Nama Kos</h4>
        <div class="bg-gray-50 border border-gray-100 rounded-2xl p-3 mb-4">
            <img id="img-denah-properti" src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=600&q=50" alt="Denah" class="w-full h-52 object-cover rounded-xl">
        </div>
        <button type="button" onclick="tutupModalDenah()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2.5 rounded-xl text-xs transition">Tutup Denah</button>
    </div>
</div>

<script>
    function bukaModalDenah(namaKos, id) {
        document.getElementById('modal-denah-title').innerText = namaKos;
        let denahDummyUrl = 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=600&q=50';
        if (id % 2 === 0) { denahDummyUrl = 'https://images.unsplash.com/photo-1545464693-f1798a373343?auto=format&fit=crop&w=600&q=50'; }
        document.getElementById('img-denah-properti').src = denahDummyUrl;
        document.getElementById('modal-denah-publik').classList.remove('hidden');
    }
    function tutupModalDenah() {
        document.getElementById('modal-denah-publik').classList.add('hidden');
    }
</script>
@endsection
