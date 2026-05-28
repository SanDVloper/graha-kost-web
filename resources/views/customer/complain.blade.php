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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100 text-sm">
                    <div>
                        <span class="block text-gray-400 font-medium">Pengirim:</span>
                        <span class="font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-400 font-medium">Kategori Judul Data:</span>
                        <span class="font-bold text-teal-600">Komplain Penghuni (Otomatis)</span>
                    </div>
                </div>

                <!-- Input Teks Keluhan -->
                <div>
                    <label for="pesan" class="block text-gray-700 font-bold mb-2 flex items-center">
                        <i class="fa-solid fa-pen-to-square mr-2 text-teal-500"></i> Detail Keluhan / Masalah
                    </label>
                    <textarea
                        name="pesan"
                        id="pesan"
                        rows="6"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition outline-none text-sm @error('pesan') border-red-400 @enderror"
                        placeholder="Contoh: Halo pengelola Graha, lampu di kamar mandi dalam kamar nomor 4 mati. Mohon dibantu untuk penggantian bohlamnya, terima kasih..."
                    >{{ old('pesan') }}</textarea>

                    @error('pesan')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-400 mt-2">Minimal keluhan berisi 10 karakter agar bisa diproses oleh sistem.</p>
                </div>

                <!-- Tombol Kirim -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-teal-600/20 transition transform hover:-translate-y-0.5 flex items-center">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Keluhan Sekarang
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
