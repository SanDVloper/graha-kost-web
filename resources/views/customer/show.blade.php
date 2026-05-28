@extends('layouts.app')

@section('content')
@php
    // Hitung nominal manual berdasarkan kecocokan tipe kosan tim kamu
    $hargaFallback = 600000;
    if($property->type == 'putri') $hargaFallback = 850000;
    if($property->type == 'putra') $hargaFallback = 750000;
    if(str_contains(strtolower($property->name), 'premium') || str_contains(strtolower($property->name), 'luxury')) {
        $hargaFallback = 1800000;
    } elseif($property->type == 'campur' && $hargaFallback == 600000) {
        $hargaFallback = 1200000;
    }

    // Mengambil foto utama berdasarkan ID kosan
    $mainPhoto = asset('image/kos' . $property->id . '.jpg');
@endphp

<div class="bg-gray-50 min-h-screen pb-20">

    <!-- Banner Foto Utama -->
    <div class="w-full h-[40vh] md:h-[50vh] relative">
        <img src="{{ $mainPhoto }}" alt="{{ $property->name }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=1200&q=50'">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

        <a href="{{ route('customer.index') }}" class="absolute top-6 left-6 bg-white/20 backdrop-blur-md hover:bg-white/40 text-white p-3 rounded-full transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    <div class="container mx-auto px-6 -mt-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom Kiri: Detail Informasi Kos -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">

                    <!-- ALERT NOTIFIKASI SUKSES -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-emerald-800 font-medium shadow-sm flex items-center">
                            <i class="fa-solid fa-circle-check mr-3 text-emerald-500 text-lg"></i>
                            <div class="text-sm">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <!-- Badge Kategori -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Kos {{ ucfirst($property->type ?? 'Umum') }}
                        </span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Berdiri {{ $property->year_established ?? 'N/A' }}
                        </span>
                    </div>

                    <!-- Judul dan Alamat -->
                    <h1 class="text-3xl font-bold text-[#1E3A8A] mb-2">{{ $property->name }}</h1>
                    <p class="text-gray-500 flex items-center mb-6">
                        <i class="fa-solid fa-location-dot mr-2 text-red-400"></i>
                        {{ $property->location ?? ($property->address ?? 'Alamat belum dilengkapi pemilik') }}
                    </p>

                    <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Kos</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ $property->description ?? 'Belum ada deskripsi untuk properti ini.' }}
                    </p>
                </div>

                <!-- Komponen Fasilitas Umum -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-4 flex items-center">
                        <i class="fa-solid fa-couch mr-2 text-teal-500"></i> Fasilitas Umum
                    </h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @if(is_array($property->facilities) && count($property->facilities) > 0)
                            @foreach($property->facilities as $facility)
                                <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                    <i class="fa-solid fa-check-circle mr-1"></i> {{ $facility }}
                                </span>
                            @endforeach
                        @elseif(is_string($property->facilities) && !empty($property->facilities))
                            <p class="text-gray-600 text-sm">{{ $property->facilities }}</p>
                        @else
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100"><i class="fa-solid fa-wifi mr-1"></i> Free Wi-Fi</span>
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100"><i class="fa-solid fa-bath mr-1"></i> K. Mandi Dalam</span>
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100"><i class="fa-solid fa-bed mr-1"></i> Kasur & Lemari</span>
                        @endif
                    </div>
                </div>

                <!-- Komponen Tipe Kamar Tersedia -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-6 flex items-center">
                        <i class="fa-solid fa-bed mr-2 text-teal-500"></i> Tipe Kamar Tersedia
                    </h3>

                    <div class="space-y-4">
                        @forelse($property->rooms ?? [] as $room)
                        <div class="border border-gray-100 rounded-2xl p-5 hover:border-teal-300 transition-colors bg-gray-50/50">
                            <div class="flex justify-between items-center flex-wrap gap-4">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-lg">{{ $room->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <i class="fa-solid fa-maximize mr-1"></i> Ukuran: {{ $room->size ?? 'Standar' }} |
                                        <i class="fa-solid fa-door-open mr-1"></i> Tersisa: {{ $room->quantity ?? 0 }} kamar
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-xs text-gray-400 uppercase font-bold">Harga Per Bulan</span>
                                    <span class="text-xl font-extrabold text-teal-600">Rp {{ number_format($room->price_monthly ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <!-- FIX HARGA: Membaca variabel hitungan manual agar sinkron dengan halaman pencarian -->
                        <div class="border border-gray-100 rounded-2xl p-5 bg-gray-50/50">
                            <div class="flex justify-between items-center flex-wrap gap-4">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-lg">Tipe Kamar Standar (Reguler)</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <i class="fa-solid fa-maximize mr-1"></i> Ukuran: 3x4 m | <i class="fa-solid fa-door-open mr-1"></i> Tersedia
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-xs text-gray-400 uppercase font-bold">Harga Per Bulan</span>
                                    <span class="text-xl font-extrabold text-teal-600">Rp {{ number_format($hargaFallback, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Card Aksi & Harga Dinamis -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 sticky top-24">
                    <div class="text-center mb-6 pb-6 border-b border-gray-100">
                        <span class="block text-sm text-gray-500 mb-1">Mulai dari</span>

                        <!-- FIX HARGA: Membaca variabel hitungan manual agar sinkron dengan halaman pencarian -->
                        <h2 class="text-3xl font-extrabold text-[#1E3A8A]">
                            @if($property->rooms && $property->rooms->count() > 0)
                                Rp {{ number_format($property->rooms->first()->price_monthly, 0, ',', '.') }}
                            @else
                                Rp {{ number_format($hargaFallback, 0, ',', '.') }}
                            @endif
                        </h2>
                        <span class="text-sm text-gray-400">/ bulan</span>
                    </div>

                    <!-- Aturan Properti -->
                    <div class="space-y-3 text-sm text-gray-600 mb-8">
                        <div class="flex justify-between">
                            <span>Aturan Listrik</span>
                            <span class="font-bold text-gray-800">{{ ucfirst($property->electricity_rule ?? 'Termasuk') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Aturan Air</span>
                            <span class="font-bold text-gray-800">{{ ucfirst($property->water_rule ?? 'Termasuk') }}</span>
                        </div>
                        @if(($property->deposit ?? 0) > 0)
                        <div class="flex justify-between">
                            <span>Deposit (Jaminan)</span>
                            <span class="font-bold text-gray-800">Rp {{ number_format($property->deposit, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Form Ajukan Sewa -->
                    <form action="{{ route('customer.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">

                        @auth
                            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-600/30 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                                <i class="fa-solid fa-calendar-check mr-2"></i> Ajukan Sewa Sekarang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-900/30 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                                <i class="fa-solid fa-right-to-bracket mr-2"></i> Login untuk Menyewa
                            </a>
                        @endauth
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
