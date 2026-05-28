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

    // 🟢 SIMULASI STATUS KAMAR FULL (Sinkron dengan halaman index)
    $isKosanPenuh = ($property->id % 5 == 0);
    $sisaKamarSimulasi = $isKosanPenuh ? 0 : (($property->id % 3 == 0) ? 2 : 4);
@endphp

<div class="bg-gray-50 min-h-screen pb-20">

    <div class="w-full h-[40vh] md:h-[50vh] relative">
        <img src="{{ $mainPhoto }}" alt="{{ $property->name }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=1200&q=50'">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

        <a href="{{ route('customer.index') }}" class="absolute top-6 left-6 bg-white/20 backdrop-blur-md hover:bg-white/40 text-white p-3 rounded-full transition-all">
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
                                <i class="fa-solid fa-circle-check mr-3 text-emerald-500 text-xl mt-0.5 animate-bounce"></i>
                                <div class="text-sm leading-relaxed">
                                    <strong class="block text-emerald-900 mb-0.5">Pengajuan Berhasil!</strong>
                                    {{ session('success') }}
                                </div>
                            </div>
                            <div class="shrink-0 w-full md:w-auto text-right">
                                <a href="/billing" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all transform active:scale-95 shadow-sm shadow-emerald-600/20">
                                    <i class="fa-solid fa-file-invoice-dollar"></i> Buka Menu Billing
                                </a>
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
                                Sisa {{ $sisaKamarSimulasi }} Kamar
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

                        @if($hargaFallback >= 1800000)
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                <i class="fa-solid fa-snowflake text-teal-500 mr-1"></i> Air Conditioner (AC)
                            </span>
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                <i class="fa-solid fa-temperature-three-quarters text-teal-500 mr-1"></i> Water Heater (Mandi Air Hangat)
                            </span>
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                <i class="fa-solid fa-tv text-teal-500 mr-1"></i> Smart TV LED 32 Inch
                            </span>
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                <i class="fa-solid fa-kitchen-set text-teal-500 mr-1"></i> Dapur Pribadi & Kulkas Mini
                            </span>
                            <span class="bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full text-xs font-bold border border-teal-100">
                                <i class="fa-solid fa-shield-halved text-teal-500 mr-1"></i> Proteksi CCTV Keamanan 24 Jam
                            </span>
                        @endif
                    </div>
                </div>

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
                        <div class="border border-gray-100 rounded-2xl p-5 bg-gray-50/50">
                            <div class="flex justify-between items-center flex-wrap gap-4">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-lg">
                                        @if($hargaFallback >= 1800000)
                                            Tipe Kamar Premium Luxury Suite
                                        @elseif($hargaFallback >= 850000)
                                            Tipe Kamar Reguler (Sistem Token)
                                        @else
                                            Tipe Kamar Ekonomi (Standar)
                                        @endif
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <i class="fa-solid fa-maximize mr-1"></i> Ukuran: {{ $hargaFallback >= 1800000 ? '4x4 m' : '3x4 m' }} |
                                        @if(!$isKosanPenuh)
                                            <i class="fa-solid fa-door-open mr-1 text-green-500"></i> <span class="text-green-600 font-bold">Tersedia (Sisa {{ $sisaKamarSimulasi }})</span>
                                        @else
                                            <i class="fa-solid fa-circle-xmark mr-1 text-red-500"></i> <span class="text-red-600 font-bold">Penuh</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-xs text-gray-400 uppercase font-bold">Harga Per Bulan</span>
                                    <span class="text-xl font-extrabold text-teal-600" id="table-harga">Rp {{ number_format($hargaFallback, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 sticky top-24">

                    <div class="text-center mb-6 pb-6 border-b border-gray-100">
                        <span class="block text-sm text-gray-500 mb-2">Pilih Durasi & Harga</span>

                        <h2 class="text-3xl font-extrabold text-[#1E3A8A]" id="display-harga">
                            Rp {{ number_format($hargaFallback, 0, ',', '.') }}
                        </h2>
                        <span class="text-sm text-gray-400" id="display-label">/ bulan</span>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pilihan Paket Sewa</label>
                        <select id="pilihan-durasi" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all text-sm font-semibold text-gray-700">
                            <option value="{{ $hargaFallback }}" data-label="/ bulan" selected>Per Bulan (Standar)</option>
                            <option value="{{ round($hargaFallback / 20) }}" data-label="/ hari">Per Hari (Sewa Pendek)</option>
                            <option value="{{ $hargaFallback * 11 }}" data-label="/ tahun">Per Tahun (Hemat Paket)</option>
                        </select>
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
                        @if(($property->deposit ?? 0) > 0)
                        <div class="flex justify-between">
                            <span>Deposit (Jaminan)</span>
                            <span class="font-bold text-gray-800">Rp {{ number_format($property->deposit, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <form action="{{ route('customer.enroll') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="durasi_sewa" id="input-durasi" value="bulan">

                        @if($isKosanPenuh)
                            <button type="button" class="w-full bg-gray-300 text-gray-500 font-bold py-4 rounded-xl cursor-not-allowed flex items-center justify-center shadow-none" disabled>
                                🚫 Maaf, Kamar Sudah Penuh
                            </button>
                        @else
                            @auth
                                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-600/30 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-check mr-2"></i> Ajukan Sewa Sekarang
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-900/30 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Login untuk Menyewa
                                </a>
                            @endauth
                        @endif
                    </form>

                    @if(!$isKosanPenuh)
                        <div class="mt-6 pt-6 border-t border-dashed border-gray-200">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Metode Pembayaran Manual</h4>

                            <div class="bg-blue-50/50 border border-blue-100/70 rounded-2xl p-4 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-[#1E3A8A] text-white text-[10px] font-black px-2 py-0.5 rounded">BCA</span>
                                        <span class="text-xs font-bold text-gray-700">Bank Central Asia</span>
                                    </div>
                                    <button type="button" onclick="salinRekening('8560112233')" class="text-xs font-bold text-teal-600 hover:text-teal-700 active:scale-95 transition-all flex items-center gap-1">
                                        <i class="fa-regular fa-copy"></i> Salin
                                    </button>
                                </div>

                                <div class="text-sm">
                                    <span class="block text-xs text-gray-400">Nomor Rekening:</span>
                                    <strong class="text-gray-800 tracking-wider text-base">8560 1122 33</strong>
                                    <span class="block text-xs text-gray-500 mt-0.5 font-medium">a.n. PT GRAHA KOST BALI</span>
                                </div>

                                <div class="text-[11px] text-amber-700 bg-amber-50 p-2.5 rounded-xl border border-amber-100 leading-relaxed">
                                    <i class="fa-solid fa-circle-info mr-1 text-amber-600"></i> <strong>Penting:</strong> Simpan bukti transfer (struk/m-banking) untuk diunggah pada konfirmasi pembayaran setelah mengajukan sewa.
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('pilihan-durasi').addEventListener('change', function() {
        let harga = parseInt(this.value);
        let label = this.options[this.selectedIndex].getAttribute('data-label');

        // Format angka ke format mata uang Rupiah (IDR)
        let formatRupiah = 'Rp ' + harga.toLocaleString('id-ID');

        // Ubah tampilan teks di layar secara dinamis
        document.getElementById('display-harga').innerText = formatRupiah;
        document.getElementById('display-label').innerText = label;

        // Ubah juga harga pada kolom tabel 'Tipe Kamar Tersedia' agar serasi
        let tableHargaElement = document.getElementById('table-harga');
        if(tableHargaElement) {
            tableHargaElement.innerText = formatRupiah;
        }

        // Sinkronisasi data string ke input hidden sebelum di-submit ke database
        document.getElementById('input-durasi').value = label.replace('/ ', '');
    });

    // FUNCTION UTK MENJALANKAN CLIBBOARD COPY NO REK
    function salinRekening(noRek) {
        navigator.clipboard.writeText(noRek).then(() => {
            alert('Nomor rekening ' + noRek + ' berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    }
</script>
@endsection
