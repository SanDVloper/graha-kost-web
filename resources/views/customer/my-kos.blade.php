@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="flex justify-start mb-4">
            <a href="{{ route('customer.index', ['bypass' => true]) }}" class="text-xs bg-white hover:bg-gray-100 text-gray-600 font-bold py-2.5 px-4 rounded-xl transition shadow-sm border border-gray-200 flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Lihat Katalog Kos Lain
            </a>
        </div>

        <div class="bg-gradient-to-r from-[#1E3A8A] to-blue-900 rounded-3xl p-8 text-white shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 opacity-10 text-9xl transform translate-x-10 translate-y-10">
                <i class="fa-solid fa-building-user"></i>
            </div>
            <span class="bg-teal-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm">
                Status: Penghuni Aktif
            </span>
            <h1 class="text-3xl font-black mt-3">{{ $property->name }}</h1>
            <p class="text-blue-100 text-sm mt-1 max-w-xl">
                <i class="fa-solid fa-location-dot text-red-400 mr-1"></i> {{ $property->location ?? $property->address ?? 'Bali' }}
            </p>

            <div class="mt-6 max-w-2xl bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                <span class="block text-[10px] uppercase font-black tracking-wider text-teal-300 mb-2">
                    <i class="fa-solid fa-map-location-dot"></i> Denah Tata Letak Properti & Aturan Jangkauan Wi-Fi
                </span>
                <div class="relative rounded-xl overflow-hidden bg-white/5 h-48 sm:h-64">
                    @php
                        // Variasi denah otomatis berdasarkan ID agar dinamis saat demo kelompok
                        $denahUrl = 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=800&q=50';
                        if ($property->id % 2 === 0) {
                            $denahUrl = 'https://images.unsplash.com/photo-1545464693-f1798a373343?auto=format&fit=crop&w=800&q=50';
                        }
                    @endphp
                    <img src="{{ $denahUrl }}" alt="Denah Properti Kos" class="w-full h-full object-cover">
                    <div class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-sm px-3 py-1 rounded-md text-[10px] font-medium text-gray-200">
                        * Format Layout Standar Wifi 3x4 meter (Kamar Mandi Dalam)
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-white/10 flex flex-wrap gap-4 text-xs text-blue-200">
                <span><i class="fa-solid fa-door-closed mr-1"></i> No. Kamar Anda: <strong>Kamar Reguler #0{{ ($property->id % 8) + 1 }}</strong></span>
                <span><i class="fa-solid fa-calendar-check mr-1"></i> Periode Cetak Tagihan: <strong>Bulanan (Setiap Tanggal 11)</strong></span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <div class="flex justify-between items-center border-b pb-3 border-gray-50">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Pusat Pembayaran Bulanan</h3>
                            <p class="text-xs text-gray-400">Bayar tagihan dan unduh kuitansi resmi kos Anda.</p>
                        </div>
                        <i class="fa-solid fa-money-check-dollar text-teal-600 text-xl"></i>
                    </div>

                    <div class="space-y-3">
                        @foreach($myBillings as $bill)
                            <div class="border border-gray-100 bg-gray-50/50 rounded-2xl p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                <div class="space-y-1">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">ID Invoice: #INV-00{{ $bill->id }}</span>
                                    <h4 class="text-lg font-black text-gray-800">Rp {{ number_format($bill->amount, 0, ',', '.') }}</h4>
                                    <p class="text-[11px] text-gray-500">Jatuh Tempo: {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}</p>
                                </div>
                                <div class="w-full sm:w-auto">
                                    @if($bill->status == 'unpaid')
                                        <a href="{{ route('customer.billing') }}" class="inline-flex bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm items-center gap-1">
                                            <i class="fa-solid fa-credit-card"></i> Bayar Tagihan
                                        </a>
                                    @else
                                        <div class="flex items-center gap-2">
                                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider"><i class="fa-solid fa-circle-check"></i> Lunas</span>
                                            <a href="{{ route('customer.invoice', $bill->id) }}" target="_blank" class="text-xs bg-white border text-gray-600 hover:bg-gray-50 font-bold px-3 py-2 rounded-xl transition">Kuitansi</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <div class="flex justify-between items-center border-b pb-3 border-gray-50">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Daftar Kamar Tetangga Kos</h3>
                            <p class="text-xs text-gray-400">Melihat daftar mahasiswa, nomor kamar, beserta jenis tipe kamar yang tersedia.</p>
                        </div>
                        <i class="fa-solid fa-people-roof text-blue-600 text-xl"></i>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($neighbors as $key => $neighbor)
                            @php
                                $tipeKamarTeks = (($neighbor->id ?? $key) % 2 == 0) ? 'Tipe Deluxe (AC + Kasur King)' : 'Tipe Reguler (Kipas + Lemari)';
                            @endphp
                            <div class="border border-gray-100 bg-gray-50/50 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-[#1E3A8A] font-bold text-sm border border-blue-100 shrink-0">
                                    {{ strtoupper(substr($neighbor->user->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-800 text-xs">{{ $neighbor->user->name ?? 'Penghuni Anonim' }}</h5>
                                    <span class="text-[10px] font-bold text-gray-500 block">No. Kamar: #0{{ (($neighbor->id ?? $key) % 10) + 1 }}</span>
                                    <span class="text-[10px] text-teal-600 font-medium block"><i class="fa-solid fa-bed mr-1"></i> {{ $tipeKamarTeks }}</span>
                                    <span class="inline-block mt-1.5 text-[8px] font-black bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded uppercase tracking-wider">Aktif Menghuni</span>
                                </div>
                            </div>
                        @empty
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="border border-gray-100 bg-gray-50/50 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-xs shrink-0">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-700 text-xs">Penghuni Kamar 0{{ $i + 1 }}</h5>
                                        <span class="text-[10px] font-bold text-gray-400 block">No. Kamar: #0{{ $i + 1 }}</span>
                                        <span class="text-[10px] text-teal-600 font-medium block"><i class="fa-solid fa-bed mr-1"></i> {{ $i % 2 == 0 ? 'Tipe Deluxe (AC + Kasur King)' : 'Tipe Reguler (Kipas + Lemari)' }}</span>
                                        <span class="inline-block mt-1.5 text-[8px] font-black bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded uppercase tracking-wider">Aktif Menghuni</span>
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                </div>

                <!-- Papan Pengumuman / Keluhan Publik -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <div class="flex justify-between items-center border-b pb-3 border-gray-50">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Papan Pengumuman & Suara Penghuni</h3>
                            <p class="text-xs text-gray-400">Pesan dan keluhan publik dari penghuni kos ini.</p>
                        </div>
                        <i class="fa-solid fa-bullhorn text-orange-500 text-xl"></i>
                    </div>

                    <div class="space-y-3">
                        @forelse($publicComplains ?? [] as $complain)
                            @php
                                $isLandlord = ($complain->user->role ?? '') === 'landlord';
                            @endphp
                            <div class="border {{ $isLandlord ? 'border-orange-200 bg-orange-50/30' : 'border-gray-100 bg-gray-50/50' }} rounded-2xl p-4 space-y-2 relative overflow-hidden">
                                @if($isLandlord)
                                    <div class="absolute top-0 right-0 bg-orange-500 text-white text-[8px] font-bold px-2 py-1 rounded-bl-lg uppercase tracking-wider">
                                        <i class="fa-solid fa-star mr-1"></i> Pengumuman Resmi
                                    </div>
                                @endif
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full {{ $isLandlord ? 'bg-orange-100 text-orange-600' : 'bg-blue-50 text-blue-600' }} flex items-center justify-center font-bold text-xs shrink-0">
                                            @if($complain->is_anonymous)
                                                <i class="fa-solid fa-user-secret"></i>
                                            @elseif($isLandlord)
                                                <i class="fa-solid fa-crown"></i>
                                            @else
                                                {{ strtoupper(substr($complain->user->name ?? 'A', 0, 1)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="font-bold {{ $isLandlord ? 'text-orange-700' : 'text-gray-800' }} text-xs flex items-center gap-1">
                                                {{ $complain->is_anonymous ? 'Penghuni Anonim' : ($isLandlord ? 'Pengelola Kos (Tuan Kos)' : ($complain->user->name ?? 'Penghuni')) }}
                                                @if($isLandlord)
                                                    <i class="fa-solid fa-circle-check text-orange-500 text-[10px]"></i>
                                                @endif
                                            </h5>
                                            <span class="text-[9px] text-gray-400">{{ \Carbon\Carbon::parse($complain->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <span class="{{ $isLandlord ? 'bg-orange-100 text-orange-700' : 'bg-blue-50 text-blue-600' }} text-[9px] font-bold px-2 py-0.5 rounded uppercase mt-1">
                                        {{ $complain->category }}
                                    </span>
                                </div>
                                <div class="bg-white border {{ $isLandlord ? 'border-orange-100' : 'border-gray-100' }} p-3 rounded-xl mt-2 shadow-sm">
                                    <h6 class="font-bold text-sm text-gray-800">{{ $complain->title }}</h6>
                                    <p class="text-xs text-gray-600 mt-1">{{ $complain->description }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <i class="fa-regular fa-comments text-gray-300 text-3xl mb-2"></i>
                                <p class="text-xs text-gray-500">Belum ada pengumuman atau keluhan publik.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="space-y-6">

                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm space-y-4">
                    <h4 class="font-bold text-gray-800 text-xs uppercase tracking-wider border-b pb-2 flex items-center gap-1.5 text-emerald-600">
                        <i class="fa-solid fa-trash-can"></i> Jadwal Pengambilan Sampah
                    </h4>
                    
                    @php
                        $garbage = is_array($property->garbage_management) ? $property->garbage_management : [];
                        $is_scheduled = $garbage['is_scheduled'] ?? false;
                        $days = is_array($garbage['days'] ?? null) ? implode(', ', $garbage['days']) : ($garbage['days'] ?? '');
                        $time = $garbage['time'] ?? '';
                        $message = $garbage['message'] ?? '';
                    @endphp

                    <div class="bg-emerald-50/50 border border-emerald-100 rounded-xl p-3.5 space-y-2">
                        @if($is_scheduled)
                            <div class="flex justify-between items-center text-xs font-semibold text-gray-700">
                                <span>Hari Pengambilan:</span>
                                <span class="text-emerald-700">{{ $days ?: '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs font-semibold text-gray-700">
                                <span>Waktu Angkut:</span>
                                <span class="text-emerald-700">{{ $time ?: '-' }}</span>
                            </div>
                        @else
                            <p class="text-xs font-medium text-emerald-800 leading-relaxed">
                                Pengelolaan sampah dilakukan secara mandiri oleh penghuni.
                            </p>
                        @endif

                        @if(!empty($message))
                        <p class="text-[10px] text-gray-500 leading-relaxed pt-2 mt-2 border-t border-dashed">
                            <i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i>
                            {{ $message }}
                        </p>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm space-y-4">
                    <h4 class="font-bold text-gray-800 text-xs uppercase tracking-wider border-b pb-2 flex items-center gap-1.5 text-[#1E3A8A]">
                        <i class="fa-solid fa-gavel"></i> Tata Tertib & Aturan Kos
                    </h4>
                    @if(!empty($property->rules) && is_array($property->rules) && count($property->rules) > 0)
                    <ul class="text-xs text-gray-600 space-y-3 font-medium">
                        @foreach($property->rules as $rule)
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-teal-500 mt-0.5 shrink-0"></i>
                                <span>{{ $rule }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="text-center py-4">
                        <p class="text-xs text-gray-400">Belum ada aturan khusus dari Tuan Kos.</p>
                    </div>
                    @endif
                </div>

                <div class="bg-amber-50 border border-amber-100 p-6 rounded-3xl space-y-3">
                    <h4 class="text-amber-800 font-bold text-sm flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation"></i> Ada Masalah Fasilitas Kamar?</h4>
                    <p class="text-xs text-amber-700 leading-relaxed">Air kamar mandi mati, token listrik bermasalah, atau Wi-Fi lelet? Sampaikan keluhan langsung melalui pusat pengaduan.</p>
                    <a href="{{ route('customer.complain.view') }}" class="block text-center bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold py-2.5 rounded-xl transition shadow-sm">Laporkan Keluhan Kamar</a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
