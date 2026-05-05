@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    <!-- HEADER SECTION -->
    <div class="bg-[#1E3A8A] pt-16 pb-24 px-6">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-white mb-2">Riwayat Tagihan</h1>
            <p class="text-blue-100 opacity-80">Kelola pembayaran sewa dan utilitas Anda dalam satu pintu.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT COLUMN: DAFTAR TAGIHAN -->
            <div class="lg:col-span-2 space-y-6">
                @forelse($billings as $bill)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <div class="flex gap-4">
                            <!-- ICON DINAMIS -->
                            <div class="w-12 h-12 rounded-xl {{ $bill->status == 'paid' ? 'bg-teal-50 text-teal-600' : 'bg-orange-50 text-orange-600' }} flex items-center justify-center text-xl shrink-0">
                                <i class="fa-solid {{ ($bill->type ?? 'sewa') == 'utilitas' ? 'fa-bolt' : 'fa-house-chimney' }}"></i>
                            </div>
                            
                            <!-- INFO TAGIHAN -->
                            <div>
                                <!-- Nilai Cadangan jika kolom description tidak ada -->
                                <h3 class="font-bold text-gray-800 text-lg">{{ $bill->description ?? 'Tagihan Sewa Kos' }}</h3>
                                <!-- Nilai Cadangan jika kolom invoice_number tidak ada -->
                                <p class="text-gray-400 text-sm">ID Tagihan: <span class="font-mono">{{ $bill->invoice_number ?? 'INV-00'.$bill->id }}</span></p>
                                <p class="text-gray-500 text-xs mt-1">Jatuh Tempo: {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:items-end justify-between">
                            <div class="text-left md:text-right">
                                <span class="block text-xs text-gray-400 uppercase font-bold tracking-wider">Total Tagihan</span>
                                <span class="text-xl font-extrabold text-[#1E3A8A]">Rp {{ number_format($bill->amount, 0, ',', '.') }}</span>
                            </div>

                            <div class="mt-4 md:mt-0">
                                <!-- STATUS PENGECEKAN KITA UBAH JADI 'pending' -->
                                @if($bill->status == 'pending')
                                <form action="{{ route('customer.pay', $bill->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-teal-700 transition shadow-lg shadow-teal-600/20">
                                        Bayar Sekarang
                                    </button>
                                </form>
                                @else
                                <span class="inline-flex items-center gap-2 bg-teal-50 text-teal-700 px-4 py-2 rounded-xl text-sm font-bold border border-teal-100">
                                    <i class="fa-solid fa-circle-check"></i> Lunas
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl p-16 text-center border border-gray-100">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-file-invoice text-3xl text-gray-200"></i>
                    </div>
                    <p class="text-gray-400 font-medium">Yeay! Tidak ada tagihan yang belum dibayar saat ini.</p>
                </div>
                @endforelse
            </div>

            <!-- RIGHT COLUMN: SUMMARY & INFO -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sticky top-24">
                    <h4 class="font-bold text-[#1E3A8A] mb-6 flex items-center">
                        <i class="fa-solid fa-circle-info mr-2 text-teal-500"></i> Informasi Pembayaran
                    </h4>

                    <ul class="space-y-4 text-sm text-gray-600">
                        <li class="flex gap-3">
                            <i class="fa-solid fa-check-double text-teal-500 mt-1 shrink-0"></i>
                            <span>Pastikan nominal transfer sesuai hingga 3 digit terakhir.</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-clock text-teal-500 mt-1 shrink-0"></i>
                            <span>Proses verifikasi otomatis memakan waktu 5-10 menit.</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-headset text-teal-500 mt-1 shrink-0"></i>
                            <span>Butuh bantuan? Gunakan fitur komplain jika pembayaran tidak terdeteksi.</span>
                        </li>
                    </ul>

                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-500 text-sm font-medium">Total Belum Dibayar</span>
                            <span class="font-bold text-orange-600 text-xl">
                                <!-- DIUBAH MENJADI 'pending' -->
                                Rp {{ number_format($billings->where('status', 'pending')->sum('amount'), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection