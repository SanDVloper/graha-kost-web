@extends('layouts.app')

@section('content')
@php
    // Mengambil foto utama berdasarkan ID kosan
    $mainPhoto = asset('image/kos' . $property->id . '.jpg');

    $sisaKamar = $property->rooms->sum('quantity');
    $isKosanPenuh = $sisaKamar <= 0;
    
    // Harga dasar untuk menentukan fasilitas & aturan simulasi (diambil dari kamar termurah)
    $hargaFallback = $property->rooms->min('price_monthly') ?? 600000;
@endphp

<div class="bg-gray-50 min-h-screen pb-20">

    <div class="w-full h-[40vh] md:h-[50vh] relative">
        <img src="{{ $mainPhoto }}" alt="{{ $property->name }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=1200&q=50'">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

        <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('customer.index') }}" class="absolute top-6 left-6 bg-white/20 backdrop-blur-md hover:bg-white/40 text-white p-3 rounded-full transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    <div class="container mx-auto px-6 -mt-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">

                    @if(session('success'))
                        <div class="mb-6 p-5 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-medium shadow-md flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-start">
                                <i class="fa-solid fa-paper-plane mr-3 text-emerald-500 text-xl mt-0.5 animate-pulse"></i>
                                <div class="text-sm leading-relaxed">
                                    <strong class="block text-emerald-900 mb-0.5">Pengajuan Terkirim Berhasil!</strong>
                                    {{ session('success') }}
                                </div>
                            </div>
                            <div class="shrink-0 w-full md:w-auto text-right">
                                <span class="inline-flex items-center gap-1.5 bg-amber-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm shadow-amber-500/20">
                                    <i class="fa-solid fa-spinner animate-spin"></i> Menunggu Konfirmasi Pemilik
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Kos {{ ucfirst($property->type ?? 'Umum') }}
                        </span>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Berdiri {{ $property->year_established ?? 'N/A' }}
                        </span>

                        @if(!$isKosanPenuh)
                            <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                Sisa {{ $sisaKamar }} Kamar
                            </span>
                        @else
                            <span class="bg-red-50 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                Kamar Penuh
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-[#1E3A8A] mb-2">{{ $property->name }}</h1>

                    <p class="text-gray-500 flex items-center mb-6">
                        <i class="fa-solid fa-location-dot mr-2 text-red-400"></i>
                        @php
                            preg_match('#\((.*?)\)#', $property->name, $match);
                            $wilayahTampil = $match[1] ?? null;
                        @endphp

                        @if($wilayahTampil)
                            {{ $wilayahTampil }}
                        @else
                            {{ $property->location ?? ($property->address ?? 'Bali') }}
                        @endif
                    </p>

                    <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Kos</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ $property->description ?? 'Belum ada deskripsi untuk properti ini.' }}
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-4 flex items-center">
                        <i class="fa-solid fa-couch mr-2 text-teal-500"></i> Fasilitas Umum Properti
                    </h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="bg-gray-50 text-gray-700 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200">
                            <i class="fa-solid fa-bath text-gray-400 mr-1"></i> K. Mandi Dalam
                        </span>
                        <span class="bg-gray-50 text-gray-700 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200">
                            <i class="fa-solid fa-bed text-gray-400 mr-1"></i> Kasur & Lemari Pakaian
                        </span>
                        <span class="bg-gray-50 text-gray-700 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200">
                            <i class="fa-solid fa-square-parking text-gray-400 mr-1"></i> Parkir Motor Luas
                        </span>

                        @if($hargaFallback >= 850000)
                            <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-xs font-bold border border-blue-100">
                                <i class="fa-solid fa-wifi text-blue-500 mr-1"></i> Free Wi-Fi Super Kencang
                            </span>
                            <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-xs font-bold border border-blue-100">
                                <i class="fa-solid fa-bolt text-blue-500 mr-1"></i> Listrik Sistem Token Mandiri
                            </span>
                            <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-xs font-bold border border-blue-100">
                                <i class="fa-solid fa-shirt text-blue-500 mr-1"></i> Ruang Jemuran Bersama
                            </span>
                        @endif
                    </div>
                </div>

                @if(!empty($property->rules))
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-4 flex items-center">
                        <i class="fa-solid fa-list-check mr-2 text-teal-500"></i> Aturan Kos
                    </h3>
                    <div class="flex flex-wrap gap-3 mt-2">
                        @foreach($property->rules as $rule)
                            <span class="flex items-center bg-red-50 text-red-700 px-4 py-2 rounded-xl text-sm font-bold border border-red-100">
                                <i class="fa-solid fa-circle-exclamation mr-2 text-red-400"></i> {{ $rule === 'Dilarang Bawa Lawan Jenis' ? 'Bukan Muhrim Dilarang Ke Kamar' : $rule }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E3A8A] mb-6 flex items-center">
                        <i class="fa-solid fa-bed mr-2 text-teal-500"></i> Tipe Kamar Tersedia
                    </h3>
                    <div class="space-y-4">
                        @foreach($property->rooms as $room)
                        <div class="border border-gray-100 rounded-2xl p-5 bg-white hover:border-teal-300 transition-colors cursor-pointer {{ $room->quantity <= 0 ? 'opacity-60 cursor-not-allowed' : '' }}" 
                             @if($room->quantity > 0) onclick="pilihKamar({{ $room->id }}, {{ $room->price_daily ?? round($room->price_monthly/20) }}, {{ $room->price_monthly }}, {{ $room->price_yearly ?? ($room->price_monthly * 11) }}, '{{ addslashes($room->name) }}')" @endif>
                            <div class="flex justify-between items-center flex-wrap gap-4">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-lg">{{ $room->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <i class="fa-solid fa-maximize mr-1"></i> Ukuran: {{ $room->size ?? '-' }} m |
                                        @if($room->quantity > 0)
                                            <i class="fa-solid fa-door-open mr-1 text-green-500"></i> <span class="text-green-600 font-bold">Tersedia (Sisa {{ $room->quantity }})</span>
                                        @else
                                            <i class="fa-solid fa-circle-xmark mr-1 text-red-500"></i> <span class="text-red-600 font-bold">Penuh</span>
                                        @endif
                                    </p>
                                    @if($room->facilities)
                                    <p class="text-xs mt-2 text-gray-400 font-medium leading-relaxed max-w-sm"><i class="fa-solid fa-couch mr-1"></i> Fasilitas: {{ implode(', ', (array) $room->facilities) }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <span class="block text-xs text-gray-400 uppercase font-bold">Harga Per Bulan</span>
                                    <span class="text-xl font-extrabold text-teal-600">Rp {{ number_format($room->price_monthly, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ulasan Penghuni -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-[#1E3A8A] flex items-center">
                            <i class="fa-solid fa-star mr-2 text-yellow-500"></i> Ulasan Penghuni
                        </h3>
                        @if($property->reviews->count() > 0)
                            <span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200 flex items-center">
                                <i class="fa-solid fa-star mr-1"></i> {{ number_format($property->reviews->avg('rating'), 1) }} / 5.0
                            </span>
                        @endif
                    </div>
                    
                    @if($property->reviews->count() > 0)
                        <div class="space-y-4">
                            @foreach($property->reviews as $review)
                            <div class="border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xs uppercase">
                                            {{ substr($review->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm text-gray-800">{{ $review->user->name }}</p>
                                            <p class="text-[10px] text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ $review->comment ?? 'Tidak ada komentar tertulis.' }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-regular fa-comment-dots text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 text-sm">Belum ada ulasan untuk kos ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Card Kontrol Pilihan Paket & Formulir -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 sticky top-24">

                    <div class="text-center mb-6 pb-6 border-b border-gray-100">
                        <span class="block text-sm text-gray-500 mb-1">Tipe Kamar Terpilih:</span>
                        <h3 class="text-lg font-bold text-gray-800" id="display-nama-kamar">Belum Memilih Kamar</h3>
                        <div class="mt-3">
                            <h2 class="text-3xl font-extrabold text-[#1E3A8A]" id="display-harga">-</h2>
                            <span class="text-sm text-gray-400" id="display-label">Silakan pilih kamar & durasi</span>
                        </div>
                    </div>

                    <!-- 🟢 MODIFIKASI: Mengubah Dropdown select lama menjadi Card Radio Button interaktif -->
                    <div class="mb-6">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-3">Pilihan Paket Termin Sewa</label>

                        <div class="space-y-3">
                            <!-- Pilihan Harian -->
                            <label id="card-harian" class="border-2 border-gray-100 rounded-2xl p-4 flex flex-col justify-between cursor-pointer hover:border-teal-500 transition-all relative block opacity-50 pointer-events-none">
                                <input type="radio" name="pilihan_paket_sewa" value="harian" class="absolute top-4 right-4 accent-teal-600" onchange="updateSkemaHarga('harian')">
                                <div>
                                    <span class="text-xs font-bold text-gray-800 block">Paket Harian</span>
                                    <span class="text-[10px] text-gray-400">Fleksibel sewa pendek</span>
                                </div>
                                <span class="text-sm font-black text-teal-600 mt-2 block" id="harga-harian">-</span>
                                <div class="bg-amber-50 text-amber-800 text-[9px] font-bold px-2 py-0.5 rounded mt-2 border border-amber-100 text-center uppercase tracking-wide">⚠️ Status Nota: Belum Lunas (Cicil)</div>
                            </label>

                            <!-- Pilihan Bulanan -->
                            <label id="card-bulanan" class="border-2 border-gray-100 rounded-2xl p-4 flex flex-col justify-between cursor-pointer hover:border-teal-500 transition-all relative block opacity-50 pointer-events-none">
                                <input type="radio" name="pilihan_paket_sewa" value="bulanan" class="absolute top-4 right-4 accent-teal-600" onchange="updateSkemaHarga('bulanan')">
                                <div>
                                    <span class="text-xs font-bold text-gray-800 block">Paket Bulanan</span>
                                    <span class="text-[10px] text-gray-400">Siklus pembayaran standar</span>
                                </div>
                                <span class="text-sm font-black text-teal-600 mt-2 block" id="harga-bulanan">-</span>
                                <div class="bg-blue-50 text-blue-800 text-[9px] font-bold px-2 py-0.5 rounded mt-2 border border-blue-100 text-center uppercase tracking-wide">Standard Operasional</div>
                            </label>

                            <!-- Pilihan Tahunan -->
                            <label id="card-tahunan" class="border-2 border-gray-100 rounded-2xl p-4 flex flex-col justify-between cursor-pointer hover:border-teal-500 transition-all relative block opacity-50 pointer-events-none">
                                <input type="radio" name="pilihan_paket_sewa" value="tahunan" class="absolute top-4 right-4 accent-teal-600" onchange="updateSkemaHarga('tahunan')">
                                <div>
                                    <span class="text-xs font-bold text-gray-800 block">Paket Tahunan</span>
                                    <span class="text-[10px] text-gray-400">Kontrak panjang lebih hemat</span>
                                </div>
                                <span class="text-sm font-black text-teal-600 mt-2 block" id="harga-tahunan">-</span>
                                <div class="bg-emerald-50 text-emerald-800 text-[9px] font-bold px-2 py-0.5 rounded mt-2 border border-emerald-100 text-center uppercase tracking-wide">✅ Status Nota: Langsung Lunas</div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600 mb-8 border-t pt-4">
                        <div class="flex justify-between">
                            <span>Aturan Listrik</span>
                            <span class="font-bold text-gray-800">{{ $hargaFallback >= 850000 ? 'Beban Token Mandiri' : 'Termasuk Sewa' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Aturan Air</span>
                            <span class="font-bold text-gray-800">{{ ucfirst($property->water_rule ?? 'Termasuk') }}</span>
                        </div>
                    </div>

                    <!-- Form Pengajuan Sewa Asli -->
                    <form id="form-ajukan-sewa" action="{{ route('customer.enroll') }}" method="POST" class="mb-2">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="room_id" id="input-room-id" value="">
                        <input type="hidden" name="durasi_sewa" id="input-durasi" value="">

                        @if($isKosanPenuh)
                            <button type="button" class="w-full bg-gray-300 text-gray-500 font-bold py-4 rounded-xl cursor-not-allowed flex items-center justify-center shadow-none" disabled>
                                🚫 Maaf, Kamar Sudah Penuh
                            </button>
                        @else
                            @auth
                                @if(Auth::user()->role === 'pencari')
                                    <button type="button" onclick="bukaModalKonfirmasi()" id="btn-ajukan" class="w-full bg-gray-300 text-gray-500 font-bold py-4 rounded-xl cursor-not-allowed flex items-center justify-center" disabled>
                                        <i class="fa-solid fa-calendar-plus mr-2"></i> Pilih Kamar Dahulu
                                    </button>
                                @else
                                    <button type="button" class="w-full bg-gray-200 text-gray-500 font-bold py-4 rounded-xl cursor-not-allowed flex items-center justify-center shadow-none" disabled>
                                        <i class="fa-solid fa-eye mr-2"></i> Mode Pratinjau (Bukan Pencari Kos)
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-900/30 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Login untuk Menyewa
                                </a>
                            @endauth
                        @endif
                    </form>

                    <p class="text-[10px] text-gray-400 text-center leading-relaxed mt-3">
                        <i class="fa-solid fa-circle-info text-blue-400"></i> Pengajuan sewa akan dikirimkan ke pemilik kos. Sesi pembayaran baru akan dibuka setelah mendapatkan persetujuan pemilik.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- POP-UP MODAL KONFIRMASI PENGAJUAN SEWA -->
<div id="modal-konfirmasi-sewa" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity flex">
    <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center shadow-2xl border border-gray-100">
        <div class="w-16 h-16 bg-blue-50/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-100">
            <i class="fa-solid fa-circle-question text-2xl text-blue-600 animate-pulse"></i>
        </div>

        <h3 class="text-lg font-extrabold text-[#1E3A8A] mb-2">Kirim Pengajuan Sewa?</h3>
        <p class="text-xs text-gray-500 leading-relaxed mb-6">
            Apakah Anda yakin ingin mengajukan sewa di kos ini? Pemilik kos akan meninjau profile data Anda sebelum memberikan persetujuan pembayaran.
        </p>

        <div class="grid grid-cols-2 gap-3">
            <button type="button" onclick="tutupModalKonfirmasi()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl text-xs transition active:scale-95">
                Batal
            </button>
            <button type="button" onclick="submitFormSewaAsli()" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-md active:scale-95">
                Ya, Kirim Pengajuan
            </button>
        </div>
    </div>
</div>

<script>
    let currentRoom = null;
    let currentPrices = { harian: 0, bulanan: 0, tahunan: 0 };
    let currentDurasi = 'bulanan';

    function pilihKamar(id, hargaHarian, hargaBulanan, hargaTahunan, nama) {
        currentRoom = id;
        currentPrices = {
            harian: hargaHarian,
            bulanan: hargaBulanan,
            tahunan: hargaTahunan
        };
        
        document.getElementById('display-nama-kamar').innerText = nama;
        document.getElementById('input-room-id').value = id;
        
        document.getElementById('harga-harian').innerText = 'Rp ' + hargaHarian.toLocaleString('id-ID');
        document.getElementById('harga-bulanan').innerText = 'Rp ' + hargaBulanan.toLocaleString('id-ID');
        document.getElementById('harga-tahunan').innerText = 'Rp ' + hargaTahunan.toLocaleString('id-ID');
        
        // Aktifkan pilihan paket
        const cards = document.querySelectorAll('label[id^="card-"]');
        cards.forEach(card => card.classList.remove('opacity-50', 'pointer-events-none'));
        
        // Pilih paket bulanan secara default tiap ganti kamar
        document.querySelector('input[value="bulanan"]').checked = true;
        updateSkemaHarga('bulanan');

        // Aktifkan tombol submit
        let btnAjukan = document.getElementById('btn-ajukan');
        if(btnAjukan) {
            btnAjukan.disabled = false;
            btnAjukan.className = "w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-600/30 transition-all transform hover:-translate-y-1 flex items-center justify-center";
            btnAjukan.innerHTML = '<i class="fa-solid fa-calendar-plus mr-2"></i> Ajukan Sewa Kos';
        }
    }

    function updateSkemaHarga(durasi) {
        if (!currentRoom) return;

        currentDurasi = durasi;
        let label = '';
        let harga = 0;
        
        if (durasi === 'harian') { label = '/ hari'; harga = currentPrices.harian; }
        if (durasi === 'bulanan') { label = '/ bulan'; harga = currentPrices.bulanan; }
        if (durasi === 'tahunan') { label = '/ tahun'; harga = currentPrices.tahunan; }

        let formatRupiah = 'Rp ' + harga.toLocaleString('id-ID');

        document.getElementById('display-harga').innerText = formatRupiah;
        document.getElementById('display-label').innerText = label;
        document.getElementById('input-durasi').value = durasi;

        // Manipulasi efek visual garis tepi border aktif (Tailwind class conversion)
        const cards = {
            harian: document.getElementById('card-harian'),
            bulanan: document.getElementById('card-bulanan'),
            tahunan: document.getElementById('card-tahunan')
        };

        Object.keys(cards).forEach(key => {
            if (cards[key]) {
                if (key === durasi) {
                    cards[key].classList.add('border-teal-500', 'bg-teal-50/10');
                    cards[key].classList.remove('border-gray-100');
                } else {
                    cards[key].classList.remove('border-teal-500', 'bg-teal-50/10');
                    cards[key].classList.add('border-gray-100');
                }
            }
        });
    }

    function bukaModalKonfirmasi() {
        document.getElementById('modal-konfirmasi-sewa').classList.remove('hidden');
    }

    function tutupModalKonfirmasi() {
        document.getElementById('modal-konfirmasi-sewa').classList.add('hidden');
    }

    function submitFormSewaAsli() {
        document.getElementById('form-ajukan-sewa').submit();
    }
    
    // Auto-select first room on page load to improve UX
    document.addEventListener('DOMContentLoaded', function() {
        const firstRoom = document.querySelector('.cursor-pointer[onclick^="pilihKamar"]');
        if (firstRoom) {
            firstRoom.click();
        }
    });
</script>
@endsection
