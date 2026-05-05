<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ready to Publish - GRAHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .custom-checkbox {
            appearance: none;
            width: 1.5rem;
            height: 1.5rem;
            border: 2px solid #cbd5e1;
            border-radius: 0.375rem;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            background-color: white;
        }
        .custom-checkbox:checked {
            background-color: #38a38e;
            border-color: #38a38e;
        }
        .custom-checkbox:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 0.875rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="bg-[#f4f7f6] text-slate-800 min-h-screen flex flex-col pb-24">

    <!-- TOP NAVIGATION BAR -->
    <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-6">
            <!-- Link kembali disesuaikan dengan ID properti -->
            <a href="{{ url('/property-cost/' . $property->id) }}" class="text-gray-500 hover:text-[#38a38e] transition-colors text-xl">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#1e3a5f]">New Property Registration</h1>
                <p class="text-sm text-gray-500 mt-0.5">Step 3 of 3</p>
            </div>
        </div>
        <button class="text-slate-500 font-bold text-lg hover:text-red-500 transition-colors">
            Cancel
        </button>
    </header>

    <!-- PROGRESS BAR SECTION -->
    <div class="max-w-4xl mx-auto px-6 w-full pt-12 pb-8">
        <div class="relative px-10">
            <div class="absolute top-1/2 left-0 w-full h-1.5 bg-gray-200 -translate-y-4 rounded-full z-0"></div>
            <div class="absolute top-1/2 left-0 w-full h-1.5 bg-[#38a38e] -translate-y-4 rounded-full z-0 transition-all duration-500"></div>

            <div class="relative z-10 flex justify-between">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-white">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-sm font-bold text-[#38a38e]">Property Profile</span>
                </div>
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-white">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-sm font-bold text-[#38a38e]">Property Cost and Type</span>
                </div>
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-white">3</div>
                    <span class="text-sm font-bold text-[#38a38e]">Ready to Publish!</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <main class="max-w-4xl mx-auto px-6 w-full flex-1">
        
        <div class="text-center mb-10 mt-4">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-teal-50 text-[#38a38e] mb-5 shadow-sm border border-teal-100">
                <i class="fa-solid fa-clipboard-check text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-[#1e3a5f] mb-3">Hampir Selesai! 🎉</h2>
            <p class="text-gray-500 text-lg">Silakan tinjau kembali data properti Anda sebelum mempublikasikannya ke platform GRAHA.</p>
        </div>

        <!-- Section 1: Profil Properti Preview -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="bg-slate-50 border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <h3 class="font-bold text-[#1e3a5f] flex items-center text-lg">
                    <i class="fa-solid fa-house-user text-[#38a38e] w-8 text-xl"></i> 1. Profil Properti
                </h3>
            </div>
            <div class="p-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Photo Placeholder -->
                    <div class="w-full md:w-1/3 aspect-video md:aspect-square bg-gray-100 rounded-xl overflow-hidden relative group border border-gray-200">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Foto Kos" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-slate-900/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer backdrop-blur-sm">
                            <span class="text-white font-bold"><i class="fa-solid fa-camera mr-2"></i>Lihat Foto</span>
                        </div>
                    </div>
                    
                    <!-- Details -->
                    <div class="flex-1 space-y-6">
                        <div>
                            <!-- Menampilkan Nama Kos dari DB -->
                            <h4 class="text-2xl font-bold text-[#1e3a5f] mb-2">{{ $property->name }}</h4>
                            <div class="flex flex-wrap gap-2 text-xs">
                                <!-- Menampilkan Tipe Kos (kapital huruf pertama) -->
                                <span class="px-3 py-1.5 bg-slate-100 text-[#1e3a5f] font-bold rounded-lg border border-gray-200">Kos {{ ucfirst($property->type) }}</span>
                                <span class="px-3 py-1.5 bg-gray-50 text-gray-500 font-semibold rounded-lg border border-gray-200">Berdiri {{ $property->year_established ?? '-' }}</span>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-400 font-bold mb-1 uppercase tracking-wider">Deskripsi Properti</p>
                            <p class="text-slate-700 font-medium flex items-start leading-relaxed">
                                <i class="fa-solid fa-align-left text-red-500 mt-1.5 mr-3"></i>
                                {{ $property->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400 font-bold mb-3 uppercase tracking-wider">Fasilitas Umum</p>
                            <div class="flex flex-wrap gap-2">
                                <!-- Looping Fasilitas Umum yang dipilih di Step 1 -->
                                @if(!empty($property->facilities))
                                    @foreach($property->facilities as $fac)
                                        <span class="text-xs font-bold text-[#38a38e] bg-teal-50 px-3 py-2 rounded-lg border border-teal-100">
                                            <i class="fa-solid fa-check mr-1.5"></i> {{ $fac }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-xs text-gray-500">Belum ada fasilitas umum yang dipilih.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Tipe & Harga Kamar Preview -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="bg-slate-50 border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <h3 class="font-bold text-[#1e3a5f] flex items-center text-lg">
                    <i class="fa-solid fa-tags text-[#38a38e] w-8 text-xl"></i> 2. Tipe & Harga Kamar
                </h3>
            </div>
            
            <div class="p-8 space-y-6">
                <!-- Looping semua kamar yang terkait dengan properti ini -->
                @forelse($property->rooms as $room)
                    <div class="border border-gray-200 rounded-xl p-6 relative overflow-hidden bg-white">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-[#1e3a5f]"></div>
                        
                        <div class="flex flex-col md:flex-row justify-between md:items-start gap-8">
                            <!-- Room Spec -->
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <h4 class="text-xl font-bold text-[#1e3a5f]">{{ $room->name }}</h4>
                                    <span class="text-xs bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-md border border-gray-200">{{ $room->quantity }} Kamar</span>
                                </div>
                                <p class="text-sm text-gray-500 mb-4 font-medium"><i class="fa-solid fa-ruler-combined mr-2 text-gray-400"></i> Ukuran: {{ $room->size }} m²</p>
                                
                                <p class="text-xs font-bold text-gray-400 mb-3 uppercase tracking-wider">Fasilitas Dalam:</p>
                                <div class="flex flex-wrap gap-x-5 gap-y-3 text-sm text-[#1e3a5f] font-semibold">
                                    @if(!empty($room->facilities))
                                        @foreach($room->facilities as $rfac)
                                            <span><i class="fa-solid fa-check text-[#38a38e] mr-2"></i> {{ $rfac }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Pricing & Billing -->
                            <div class="bg-[#f4f5f7] rounded-xl p-5 md:min-w-[320px] border border-gray-200">
                                <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Skema Harga & Penagihan</h5>
                                
                                @if($room->price_monthly)
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm font-semibold text-gray-600">Sewa Bulanan</span>
                                    <!-- Format angka menjadi Rupiah -->
                                    <span class="font-bold text-[#1e3a5f] text-lg">Rp {{ number_format($room->price_monthly, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                
                                @if($room->price_daily)
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm font-semibold text-gray-600">Sewa Harian</span>
                                    <span class="font-bold text-[#1e3a5f] text-lg">Rp {{ number_format($room->price_daily, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                
                                <div class="flex justify-between items-center mb-5 pb-5 border-b border-gray-200">
                                    <span class="text-sm font-semibold text-gray-600">Deposit Awal</span>
                                    <span class="font-bold text-[#1e3a5f] text-lg">Rp {{ number_format($property->deposit, 0, ',', '.') }}</span>
                                </div>

                                <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Sistem Utilitas (Billing)</h5>
                                <ul class="space-y-3 text-sm">
                                    <li class="flex justify-between items-center text-[#1e3a5f] font-semibold">
                                        <span><i class="fa-solid fa-bolt text-yellow-500 w-6"></i> Listrik</span>
                                        <span class="font-bold text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-2.5 py-1 rounded-md">
                                            @if($property->electricity_rule == 'include') Termasuk Sewa 
                                            @elseif($property->electricity_rule == 'meteran') Terpisah (Meteran)
                                            @else Token Mandiri @endif
                                        </span>
                                    </li>
                                    <li class="flex justify-between items-center text-[#1e3a5f] font-semibold">
                                        <span><i class="fa-solid fa-droplet text-blue-500 w-6"></i> Air</span>
                                        <span class="font-bold text-xs bg-teal-50 text-[#38a38e] border border-teal-200 px-2.5 py-1 rounded-md">
                                            @if($property->water_rule == 'include') Termasuk Sewa 
                                            @else Flat: Rp {{ number_format($property->water_price, 0, ',', '.') }} @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 italic">Belum ada kamar yang ditambahkan.</p>
                @endforelse
            </div>
        </div>

        <!-- Terms and Agreement -->
        <div class="bg-blue-50/50 rounded-2xl border border-blue-100 p-8 mb-8">
            <label class="flex items-start cursor-pointer group">
                <input type="checkbox" id="agreement-check" class="custom-checkbox mt-1 shrink-0">
                <div class="ml-4">
                    <span class="block text-lg font-bold text-[#1e3a5f] mb-2 group-hover:text-[#38a38e] transition-colors">Saya menyatakan bahwa seluruh data yang diisi adalah benar.</span>
                    <span class="block text-sm text-gray-600 leading-relaxed font-medium">
                        Dengan mempublikasikan properti ini, saya menyetujui <a href="#" class="text-[#38a38e] font-bold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-[#38a38e] font-bold hover:underline">Kebijakan Privasi</a> dari platform manajemen properti GRAHA. Saya memahami bahwa data tagihan akan diproses secara otomatis oleh sistem.
                    </span>
                </div>
            </label>
        </div>

    </main>

    <!-- Bottom Action Bar (Fixed) -->
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-5 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)] z-40">
        <div class="max-w-4xl mx-auto flex items-center justify-between px-2">
            <a href="{{ url('/property-cost/' . $property->id) }}" class="px-6 py-3.5 bg-white text-gray-600 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali Edit
            </a>
            <!-- Ketika ditekan sukses, diarahkan kembali ke Dashboard Utama -->
            <button type="button" id="publish-btn" class="px-8 py-3.5 bg-[#1e3a5f] text-white font-bold rounded-xl hover:bg-slate-800 shadow-lg shadow-slate-800/30 transition transform hover:-translate-y-0.5 flex items-center text-lg">
                <i class="fa-solid fa-rocket mr-3"></i> Publikasikan Properti
            </button>
        </div>
    </div>

    <!-- LOGIKA JQUERY -->
    <script type="module">
        $(document).ready(function() {
            // Logika Validasi Submit
            $('#publish-btn').click(function(e) {
                if (!$('#agreement-check').is(':checked')) {
                    e.preventDefault();
                    
                    let agreementBox = $('.bg-blue-50\\/50');
                    agreementBox.addClass('border-red-400 bg-red-50');
                    setTimeout(() => {
                        agreementBox.removeClass('border-red-400 bg-red-50');
                    }, 800);

                    alert("Mohon centang kotak persetujuan (Syarat & Ketentuan) terlebih dahulu, Tuanku!");
                } else {
                    let btn = $(this);
                    btn.html('<i class="fa-solid fa-circle-notch fa-spin mr-3"></i> Menyimpan Data...');
                    btn.removeClass('bg-[#1e3a5f]').addClass('bg-gray-400 cursor-not-allowed pointer-events-none');
                    
                    setTimeout(() => {
                        window.location.href = "{{ url('/') }}";
                    }, 1500);
                }
            });
        });
    </script>
</body>
</html>