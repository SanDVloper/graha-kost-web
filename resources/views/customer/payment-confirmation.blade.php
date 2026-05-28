@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-10 pb-20">
    <!-- 🟢 KOPOMNEN FORM UNGGAH BUKTI TRANSFER -->
    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 max-w-md mx-auto relative overflow-hidden">

        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-teal-100">
                <i class="fa-solid fa-file-invoice-dollar text-2xl text-teal-600"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1E3A8A] mb-1">Konfirmasi Pembayaran</h3>
            <p class="text-xs text-gray-500 max-w-xs mx-auto">Pesanan kosmu berhasil diajukan! Silakan unggah foto struk ATM atau screenshot m-banking resmi Anda untuk verifikasi admin.</p>
        </div>

        <!-- Alamat action bisa disesuaikan dengan route billing/payment kelompokmu nantinya -->
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Detail Informasi Pembayaran Singkat -->
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 text-xs space-y-2 text-gray-600">
                <div class="flex justify-between">
                    <span>Metode Transfer:</span>
                    <span class="font-bold text-gray-800">Bank BCA Manual</span>
                </div>
                <div class="flex justify-between">
                    <span>Rekening Tujuan:</span>
                    <span class="font-bold text-gray-800">8560 1122 33 (PT GRAHA KOST)</span>
                </div>
            </div>

            <!-- Komponen Area Upload Drag & Drop Interaktif -->
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Upload Bukti Transfer</label>
                <div class="relative border-2 border-dashed border-gray-200 hover:border-teal-400 rounded-2xl p-8 text-center bg-gray-50/50 transition-colors group">

                    <!-- Input File Tersembunyi tapi Area Kliknya Penuh setebal Box -->
                    <input type="file" name="bukti_transfer" accept="image/*" required
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        onchange="previewImage(this)">

                    <!-- Tampilan Awal Panduan Sebelum Upload -->
                    <div id="upload-placeholder" class="space-y-2">
                        <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-300 group-hover:text-teal-500 transition-colors transform group-hover:-translate-y-1 duration-300"></i>
                        <p class="text-xs font-bold text-gray-600">Klik atau seret foto struk ke sini</p>
                        <p class="text-[10px] text-gray-400">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
                    </div>

                    <!-- Komponen Preview Gambar (Akan muncul otomatis setelah file dipilih) -->
                    <div id="preview-container" class="hidden space-y-3">
                        <img id="image-preview" class="mx-auto max-h-48 rounded-xl shadow-md border border-gray-100" alt="Preview Bukti">
                        <p class="text-[11px] text-teal-600 font-semibold flex items-center justify-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> File berhasil dipilih! Klik area gambar jika ingin mengganti.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit Kirim Bukti -->
            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-600/30 transition-all transform active:scale-95 text-sm flex items-center justify-center">
                <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Bukti Pembayaran
            </button>

            <!-- Tombol Kembali/Batal -->
            <a href="{{ route('customer.index') }}" class="block text-center text-xs text-gray-400 hover:text-gray-600 font-semibold mt-2 transition-colors">
                Kembali ke Halaman Utama
            </a>
        </form>
    </div>
</div>

<!-- 🟢 JAVASCRIPT LIVE PREVIEW GAMBAR -->
<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Masukkan data gambar ke tag src img
                document.getElementById('image-preview').src = e.target.result;
                // Sembunyikan panduan teks awal
                document.getElementById('upload-placeholder').classList.add('hidden');
                // Munculkan kontainer preview gambar
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
