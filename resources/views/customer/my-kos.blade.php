@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-6 max-w-5xl">

        <!-- Header Dasbor Hunian -->
        <div class="bg-gradient-to-r from-[#1E3A8A] to-blue-900 rounded-3xl p-8 text-white shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 opacity-10 text-9xl transform translate-x-10 translate-y-10">
                <i class="fa-solid fa-building-user"></i>
            </div>
            <span class="bg-teal-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm">
                Status: Penghuni Aktif
            </span>
            <h1 class="text-3xl font-black mt-3">Kos Graha Dewata (Panjer, Denpasar)</h1>
            <p class="text-blue-100 text-sm mt-1 max-w-xl">Selamat datang di ruang hunian digital Anda. Kelola pembayaran billing bulanan dan sampaikan keluhan fasilitas kamar Anda secara langsung di bawah ini.</p>

            <div class="mt-4 pt-4 border-t border-white/10 flex flex-wrap gap-4 text-xs text-blue-200">
                <span><i class="fa-solid fa-door-closed mr-1"></i> No. Kamar: <strong>Kamar Ekonomi 04</strong></span>
                <span><i class="fa-solid fa-calendar-check mr-1"></i> Mulai Sewa: <strong>11 Jun 2026</strong></span>
            </div>
        </div>

        <!-- Grid Menu Utama Transaksional Hunian -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- CARD UTAMA 1: BLOK AKSES KE MENU BILLING -->
            <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-100 flex flex-col justify-between hover:border-teal-300 transition-colors group">
                <div>
                    <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center mb-5 border border-teal-100 group-hover:bg-teal-600 transition-colors duration-300">
                        <i class="fa-solid fa-wallet text-2xl text-teal-600 group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Billing & Tagihan Saya</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Lihat riwayat invoice, lakukan transaksi via transfer/QRIS, serta unggah bukti struk pembayaran sewa kos Anda bulan ini.</p>
                </div>
                <div class="mt-8">
                    <a href="{{ route('customer.billing') }}" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold px-5 py-3 rounded-xl transition shadow-sm w-full justify-center transform active:scale-95">
                        <i class="fa-solid fa-money-bill-wave"></i> Buka Manajemen Billing
                    </a>
                </div>
            </div>

            <!-- CARD UTAMA 2: BLOK AKSES KE MENU KOMPLAIN -->
            <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-100 flex flex-col justify-between hover:border-red-300 transition-colors group">
                <div>
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-5 border border-red-100 group-hover:bg-red-500 transition-colors duration-300">
                        <i class="fa-solid fa-circle-exclamation text-2xl text-red-500 group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Pusat Komplain Fasilitas</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Mengalami kendala air mati, listrik token bermasalah, atau fasilitas kamar rusak? Ajukan laporan keluhan Anda agar segera ditindaklanjuti pemilik.</p>
                </div>
                <div class="mt-8">
                    <a href="{{ route('customer.complain.view') }}" class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-5 py-3 rounded-xl transition shadow-sm w-full justify-center transform active:scale-95">
                        <i class="fa-solid fa-bullhorn"></i> Laporkan Komplain Kamar
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
