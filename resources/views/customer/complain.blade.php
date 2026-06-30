@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-6 max-w-3xl">

        <!-- Header Halaman -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-[#1E3A8A]">Pusat Bantuan & Komplain</h1>
            <p class="text-gray-500 mt-2">Punya keluhan terkait fasilitas kamar atau lingkungan kos? Sampaikan kepada kami di bawah ini.</p>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-emerald-800 font-medium shadow-sm flex items-center">
                <i class="fa-solid fa-circle-check mr-3 text-emerald-500 text-lg"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <!-- Card Form Komplain -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <form action="{{ route('customer.complain') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Informasi Otomatis -->
                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 text-sm mb-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-user text-gray-400"></i>
                        <div>
                            <span class="block text-gray-400 font-medium">Pengirim:</span>
                            <span class="font-bold text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Input Judul & Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-gray-700 font-bold mb-2">Judul Keluhan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition outline-none text-sm" placeholder="Contoh: Lampu Kamar Mati">
                    </div>
                    <div>
                        <label for="category" class="block text-gray-700 font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" id="category" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition outline-none text-sm appearance-none">
                            <option value="Fasilitas">Fasilitas (AC, Lampu, Air, dll)</option>
                            <option value="Keamanan">Keamanan</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <!-- Input Teks Keluhan -->
                <div>
                    <label for="pesan" class="block text-gray-700 font-bold mb-2 flex items-center">
                        <i class="fa-solid fa-pen-to-square mr-2 text-teal-500"></i> Detail Keluhan / Masalah <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="pesan"
                        id="pesan"
                        required
                        rows="5"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition outline-none text-sm @error('pesan') border-red-400 @enderror"
                        placeholder="Contoh: Halo pengelola Graha, lampu di kamar mandi mati. Mohon dibantu untuk penggantian bohlamnya, terima kasih..."
                    >{{ old('pesan') }}</textarea>

                    @error('pesan')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pengaturan Privasi & Visibilitas -->
                <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-5 space-y-4">
                    <h3 class="font-bold text-[#1E3A8A] text-sm"><i class="fa-solid fa-shield-halved mr-1"></i> Pengaturan Privasi</h3>
                    
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500 cursor-pointer">
                        <label for="is_anonymous" class="text-sm font-medium text-gray-700 cursor-pointer">Kirim sebagai Anonim (Sembunyikan identitas saya)</label>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Siapa yang bisa melihat komplain ini?</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-white bg-gray-50 transition-colors">
                                <input type="radio" name="visibility" value="landlord_only" checked class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                <span class="ml-3 text-sm font-medium text-gray-700">Hanya Tuan Kos (Privat)</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-white bg-gray-50 transition-colors">
                                <input type="radio" name="visibility" value="public" class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                <span class="ml-3 text-sm font-medium text-gray-700">Semua Penghuni (Broadcast Publik)</span>
                            </label>
                        </div>
                        <p class="text-[11px] text-gray-500 mt-2">* Komplain publik akan muncul di Papan Pengumuman dashboard penghuni lain.</p>
                    </div>
                </div>

                <!-- Tombol Kirim -->
                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-teal-600/20 transition transform hover:-translate-y-0.5 flex items-center">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Keluhan Sekarang
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
