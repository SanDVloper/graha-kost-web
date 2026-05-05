@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    
    @php
        // Logika aman untuk mengambil foto
        $photos = (!empty($property->photos) && is_array($property->photos)) ? $property->photos : [];
        $mainPhoto = count($photos) > 0 ? asset('storage/' . $photos[0]) : 'https://via.placeholder.com/1200x500?text=Graha+Kos';
    @endphp

    <!-- BAGIAN 1: FOTO COVER -->
    <div class="w-full h-[40vh] md:h-[50vh] relative">
        <img src="{{ $mainPhoto }}" alt="{{ $property->name }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        
        <!-- Tombol Kembali -->
        <a href="{{ route('customer.index') }}" class="absolute top-6 left-6 bg-white/20 backdrop-blur-md hover:bg-white/40 text-white p-3 rounded-full transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    <!-- BAGIAN 2: KONTEN UTAMA -->
    <div class="container mx-auto px-6 -mt-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI (Detail Properti) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Header Info -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Kos {{ ucfirst($property->type ?? 'Umum') }}
                        </span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Berdiri {{ $property->year_established ?? 'N/A' }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-[#1E3A8A] mb-2">{{ $property->name }}</h1>
                    <p class="text-gray-500 flex items-center mb-6">
                        <i class="fa-solid fa-location-dot mr-2 text-red-400"></i> 
                        {{ $property->address ?? 'Alamat belum dilengkapi pemilik' }}
                    </p>

                    <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Kos</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ $property->description ?? 'Belum ada deskripsi untuk properti ini.' }}
                    </p>
                </div>

                <!-- Fasilitas Umum -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-4 flex items-center">
                        <i class="fa-solid fa-couch mr-2 text-teal-500"></i> Fasilitas Umum
                    </h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @if(is_array($property->facilities) && count($property->facilities) > 0)
                            <!-- Jika datanya Array, kita buatkan bentuk Badge/Label yang keren -->
                            @foreach($property->facilities as $facility)
                                <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                    <i class="fa-solid fa-check-circle mr-1"></i> {{ $facility }}
                                </span>
                            @endforeach
                        @elseif(is_string($property->facilities) && !empty($property->facilities))
                            <!-- Jika datanya String (teks biasa), langsung tampilkan -->
                            <p class="text-gray-600 text-sm">{{ $property->facilities }}</p>
                        @else
                            <!-- Jika kosong -->
                            <p class="text-gray-500 italic text-sm">Fasilitas umum belum didaftarkan.</p>
                        @endif
                    </div>
                </div>

                <!-- Daftar Kamar -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-6 flex items-center">
                        <i class="fa-solid fa-bed mr-2 text-teal-500"></i> Tipe Kamar Tersedia
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($property->rooms as $room)
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
                        <p class="text-gray-500 italic text-sm">Belum ada data kamar yang diinputkan oleh pemilik.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN (Sticky Booking Card) -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 sticky top-24">
                    <div class="text-center mb-6 pb-6 border-b border-gray-100">
                        <span class="block text-sm text-gray-500 mb-1">Mulai dari</span>
                        <h2 class="text-3xl font-extrabold text-[#1E3A8A]">
                            Rp {{ number_format($property->rooms->min('price_monthly') ?? 0, 0, ',', '.') }}
                        </h2>
                        <span class="text-sm text-gray-400">/ bulan</span>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600 mb-8">
                        <div class="flex justify-between">
                            <span>Aturan Listrik</span>
                            <span class="font-bold text-gray-800">{{ ucfirst($property->electricity_rule ?? 'Termasuk') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Aturan Air</span>
                            <span class="font-bold text-gray-800">{{ ucfirst($property->water_rule ?? 'Termasuk') }}</span>
                        </div>
                        @if($property->deposit > 0)
                        <div class="flex justify-between">
                            <span>Deposit (Jaminan)</span>
                            <span class="font-bold text-gray-800">Rp {{ number_format($property->deposit, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- FORM BOOKING -->
                    <form action="{{ route('customer.enroll') }}" method="POST">
                        @csrf
                        <!-- Input hidden untuk mengirim ID Kos -->
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        
                        @auth
                            <!-- Jika sudah login -->
                            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-600/30 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                                <i class="fa-solid fa-calendar-check mr-2"></i> Ajukan Sewa Sekarang
                            </button>
                        @else
                            <!-- Jika belum login (Guest/Pencari) -->
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