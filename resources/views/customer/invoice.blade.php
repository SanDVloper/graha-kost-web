@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <!-- Kontainer Nota Kuitansi (Area yang akan dicetak bersih) -->
    <div id="nota-kuitansi" class="container mx-auto max-w-2xl bg-white p-10 rounded-3xl shadow-lg border border-gray-200 relative">

        <!-- Header Identitas Kuitansi -->
        <div class="flex justify-between items-start border-b pb-6 border-dashed">
            <div>
                <h1 class="text-2xl font-black text-[#1E3A8A] flex items-center">
                    <i class="fa-solid fa-house-chimney text-teal-500 mr-2"></i>GRAHA
                </h1>
                <p class="text-xs text-gray-400 mt-1">Sistem Manajemen Kos Digital Terintegrasi</p>
            </div>
            <div class="text-right">
                <span class="bg-blue-100 text-blue-800 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    KUITANSI DIGITAL
                </span>
                <p class="text-xs text-gray-500 mt-2">No. Invoice: <span class="font-mono font-bold text-gray-800">INV-2026-0041</span></p>
                <p class="text-[11px] text-gray-400">Tanggal Cetak: 11 Juni 2026</p>
            </div>
        </div>

        <!-- Detail Penyewa & Properti -->
        <div class="grid grid-cols-2 gap-4 my-6 text-xs">
            <div>
                <h4 class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Diterima Dari (Pencari/Penghuni):</h4>
                <p class="font-bold text-gray-800 mt-1">{{ Auth::user()->name }}</p>
                <p class="text-gray-500">Pemohon Sewa Kamar Kos</p>
            </div>
            <div class="text-right">
                <h4 class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Lokasi Properti Sasaran:</h4>
                <p class="font-bold text-gray-800 mt-1">Kos Graha Dewata</p>
                <p class="text-gray-500">Panjer, Denpasar Selatan, Bali</p>
            </div>
        </div>

        <!-- Rincian Simulasi Nominal Pembayaran -->
        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 my-6">
            <table class="w-full text-xs text-left">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-400">
                        <th class="pb-2">Deskripsi Skema Sewa</th>
                        <th class="pb-2 text-center">Durasi Pengajuan</th>
                        <th class="pb-2 text-right">Total Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-gray-800 font-medium">
                        <td class="pt-3">
                            Sewa Kamar Kos (Simulasi Pilihan Paket Harian)<br>
                            <span class="text-[10px] text-gray-400 font-normal">*Siklus normal operasional kos dihitung per bulan</span>
                        </td>
                        <td class="pt-3 text-center">1 Hari</td>
                        <td class="pt-3 text-right font-bold text-gray-900">Rp 50.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Logika Keterangan Kuitansi Sesuai Durasi Pilihan -->
        <div class="my-6 border-t pt-4 flex justify-between items-center">
            <div>
                <h4 class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Keterangan Status Kuitansi:</h4>
                <!-- Skenario: Menampilkan tanda cicil/belum lunas jika memilih jangka harian pendek -->
                <span class="inline-block mt-1 bg-amber-100 text-amber-800 font-black text-xs px-3 py-1 rounded-lg uppercase tracking-wide">
                    ⚠️ BELUM LUNAS (Mencicil Harian)
                </span>
            </div>
            <div class="text-right">
                <p class="text-[10px] text-gray-400 font-medium">Total Dana Masuk</p>
                <p class="text-xl font-black text-teal-600">Rp 50.000</p>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl text-[11px] text-blue-700 leading-relaxed mb-6">
            <i class="fa-solid fa-circle-info mr-1"></i> <strong>Instruksi Validasi:</strong> Klik tombol biru di bawah untuk mencetak/menyimpan file kuitansi ini ke format PDF. Setelah terunduh, silakan unggah kembali dokumen tersebut ke form bukti agar pemilik kos segera memverifikasi pelunasan Anda.
        </div>

        <!-- Tombol Cetak (Otomatis Tersembunyi Saat Proses Print/Save PDF Berlangsung) -->
        <div class="mt-8 flex gap-3 id-tombol-aksi">
            <button type="button" onclick="unduhKuitansiPDF()" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white text-xs font-bold py-3.5 rounded-xl transition shadow-md flex items-center justify-center gap-2 active:scale-95">
                <i class="fa-solid fa-file-arrow-down"></i> Cetak & Unduh Kuitansi PDF
            </button>
            <a href="{{ route('customer.myKos') }}" class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-600 text-center text-xs font-bold py-3.5 rounded-xl transition flex items-center justify-center">
                Kembali
            </a>
        </div>
    </div>
</div>

<script>
    function unduhKuitansiPDF() {
        // Sembunyikan blok tombol aksi agar hasil cetak PDF rapi dan bersih
        const tombolAksi = document.querySelector('.id-tombol-aksi');
        tombolAksi.style.display = 'none';

        // Picu perintah print sistem operasi
        window.print();

        // Tampilkan kembali tombol aksi sesaat setelah dialog print selesai
        setTimeout(() => {
            tombolAksi.style.display = 'flex';
        }, 1000);
    }
</script>

<style>
    /* Rule CSS khusus cetak: Mengisolasi halaman agar hanya mencetak box kuitansi */
    @media print {
        body * {
            visibility: hidden;
        }
        #nota-kuitansi, #nota-kuitansi * {
            visibility: visible;
        }
        #nota-kuitansi {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none;
            border: none;
            padding: 0;
        }
    }
</style>
@endsection
