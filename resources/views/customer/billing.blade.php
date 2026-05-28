@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-6 max-w-5xl">

        <!-- Header Halaman -->
        <div class="mb-8 flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#1E3A8A]">Riwayat Tagihan</h1>
                <p class="text-gray-500 mt-1">Kelola pembayaran sewa dan utilitas Anda dalam satu pintu.</p>
            </div>
        </div>

        <!-- Alert Notifikasi Pembayaran Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-emerald-800 font-medium shadow-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check mr-3 text-emerald-500 text-lg"></i>
                    <div class="text-sm">{{ session('success') }}</div>
                </div>
                @if(session('invoice_id'))
                    <a href="{{ route('customer.invoice', session('invoice_id')) }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-1.5 px-4 rounded-lg transition flex items-center">
                        <i class="fa-solid fa-print mr-1.5"></i> Cetak Kuitansi
                    </a>
                @endif
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom Kiri: Daftar Card Tagihan -->
            <div class="lg:col-span-2 space-y-4">
                @forelse($billings ?? [] as $billing)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 hover:border-teal-100 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-orange-50 rounded-2xl text-orange-500 text-xl hidden sm:block">
                            <i class="fa-solid fa-house-user"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-gray-800 text-lg">Tagihan Sewa Kos</h3>
                            <p class="text-xs text-gray-400 mt-0.5 uppercase tracking-wider font-semibold">ID Tagihan: INV-00{{ $billing->id }}</p>
                            <p class="text-xs text-gray-500 mt-1 flex items-center">
                                <i class="fa-solid fa-calendar-days mr-1 text-gray-400"></i> Jatuh Tempo: {{ \Carbon\Carbon::parse($billing->due_date)->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Bagian Harga, Badge Status, dan Tombol Aksi -->
                    <div class="text-left md:text-right w-full md:w-auto flex flex-row md:flex-col justify-between md:justify-center items-center md:items-end gap-2 border-t md:border-t-0 pt-3 md:pt-0 border-gray-50">
                        <div>
                            <span class="block text-xs text-gray-400 uppercase font-bold tracking-wider">Total Tagihan</span>
                            <span class="text-xl font-extrabold text-[#1E3A8A]">Rp {{ number_format($billing->amount, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex flex-col items-end gap-2 w-full sm:w-auto">
                            @if($billing->status == 'paid')
                                <div class="flex flex-col items-end gap-1.5">
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider flex items-center w-fit">
                                        <i class="fa-solid fa-circle-check mr-1.5 text-emerald-500"></i> Lunas
                                    </span>
                                    <a href="{{ route('customer.invoice', $billing->id) }}" target="_blank" class="text-xs text-teal-600 hover:text-teal-800 font-bold flex items-center mt-1">
                                        <i class="fa-solid fa-file-invoice-dollar mr-1"></i> Lihat Kuitansi
                                    </a>
                                </div>
                            @else
                                <span class="bg-amber-50 text-amber-700 border border-amber-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider flex items-center w-fit mb-1">
                                    <i class="fa-solid fa-clock mr-1.5 text-amber-500"></i> Belum Dibayar
                                </span>

                                <!-- Form Pilihan Metode Pembayaran Interaktif -->
                                <div class="w-full sm:w-48 text-left space-y-2">
                                    <select id="select-method-{{ $billing->id }}" required class="w-full bg-gray-50 border border-gray-200 text-[11px] rounded-xl px-2.5 py-1.5 outline-none focus:ring-2 focus:ring-teal-500 text-gray-700 font-medium">
                                        <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                                        <option value="qris">QRIS (Scan via BRImo, Livin', BCA Mobile / E-Wallet)</option>
                                        <option value="bri">Transfer Bank BRI</option>
                                        <option value="bca">Transfer Bank BCA</option>
                                        <option value="mandiri">Transfer Bank Mandiri</option>
                                    </select>

                                    <button type="button" onclick="prosesBayarSimulasi({{ $billing->id }}, '{{ number_format($billing->amount, 0, ',', '.') }}')" class="w-full bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold py-2 px-4 rounded-xl shadow-md transition transform hover:-translate-y-0.5 flex items-center justify-center">
                                        <i class="fa-solid fa-credit-card mr-1.5"></i> Bayar Sekarang
                                    </button>
                                </div>

                                <!-- Form Hidden Asli yang Akan di-Submit oleh JavaScript -->
                                <form id="form-bayar-{{ $billing->id }}" action="{{ route('customer.pay', $billing->id) }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white p-12 rounded-3xl text-center border border-gray-100 shadow-sm">
                    <div class="text-gray-300 text-5xl mb-3">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada riwayat tagihan sewa untuk akun Anda.</p>
                </div>
                @endforelse
            </div>

            <!-- Kolom Kanan: Card Informasi Pembayaran -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 sticky top-24 space-y-6">
                    <div>
                        <h3 class="font-bold text-gray-800 text-base flex items-center">
                            <i class="fa-solid fa-circle-info text-blue-500 mr-2"></i> Informasi Pembayaran
                        </h3>
                        <ul class="mt-4 space-y-3 text-xs text-gray-600 leading-relaxed">
                            <li class="flex items-start">
                                <i class="fa-solid fa-check text-teal-500 mr-2 mt-0.5"></i>
                                <span>Pastikan nominal transfer sesuai hingga 3 digit terakhir.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-check text-teal-500 mr-2 mt-0.5"></i>
                                <span>Proses verifikasi otomatis memakan waktu 5-10 menit.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-check text-teal-500 mr-2 mt-0.5"></i>
                                <span>Butuh bantuan? Gunakan fitur komplain jika pembayaran tidak terdeteksi.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Belum Dibayar</span>
                        <span class="text-lg font-extrabold text-orange-600">
                            @php
                                $totalBelumDibayar = $billings ? $billings->where('status', 'unpaid')->sum('amount') : 0;
                            @endphp
                            Rp {{ number_format($totalBelumDibayar, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ==================== MODAL SIMULASI QRIS INTERAKTIF ==================== -->
<div id="modal-qris" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4 transition-opacity">
    <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center shadow-2xl border border-gray-100 animate-fade-in">
        <div class="flex justify-between items-center mb-4">
            <span class="text-sm font-extrabold text-teal-600 flex items-center">
                <i class="fa-solid fa-qrcode mr-2 text-base"></i> SIMULASI QRIS MOCK
            </span>
            <button onclick="tutupModal()" class="text-gray-400 hover:text-gray-600 text-sm"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <p class="text-xs text-gray-500 mb-2">Pindai kode QR di bawah menggunakan aplikasi e-Banking atau e-Wallet kesayangan Anda.</p>

        <!-- Frame Gambar QR Code Simulasi -->
        <div class="bg-white border-2 border-dashed border-gray-200 p-4 rounded-2xl inline-block mx-auto mb-4">
            <!-- Menggunakan QR Generator API publik gratis untuk simulasi dinamis -->
            <img id="img-qris" src="" alt="QRIS Graha Kos" class="w-48 h-48 mx-auto object-contain">
        </div>

        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 text-left mb-5">
            <span class="block text-[10px] uppercase font-bold text-gray-400 tracking-wide">Nominal Tagihan</span>
            <span id="text-modal-harga" class="text-lg font-black text-[#1E3A8A]">Rp 0</span>
        </div>

        <!-- Tombol pura-pura bayar sukses -->
        <button id="btn-submit-qris" type="button" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center">
            <i class="fa-solid fa-circle-check mr-2"></i> Simulasikan Bayar Sukses
        </button>
    </div>
</div>

<script>
    function prosesBayarSimulasi(id, hargaFormatted) {
        const method = document.getElementById('select-method-' + id).value;
        if (!method) {
            alert('Silakan pilih metode pembayaran terlebih dahulu!');
            return;
        }

        if (method === 'qris') {
            // Tampilkan Modal QRIS
            document.getElementById('text-modal-harga').innerText = 'Rp ' + hargaFormatted;
            // Generate QR Code dummy dinamis menggunakan API QR gratis agar terlihat riil
            document.getElementById('img-qris').src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=GRAHA-BILLING-INV-' + id;
            document.getElementById('modal-qris').classList.remove('hidden');

            // Set aksi tombol sukses di modal agar menembak form asli
            document.getElementById('btn-submit-qris').onclick = function() {
                document.getElementById('form-bayar-' + id).submit();
            };
        } else {
            // Jika memilih Bank Transfer biasa, langsung konfirmasi bayar demi kelancaran demo
            if(confirm('Simulasi Transfer Bank Berhasil dilakukan. Klik OK untuk konfirmasi pelunasan.')) {
                document.getElementById('form-bayar-' + id).submit();
            }
        }
    }

    function tutupModal() {
        document.getElementById('modal-qris').classList.add('hidden');
    }
</script>
@endsection
