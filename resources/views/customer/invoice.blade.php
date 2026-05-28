<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran Resmi - GRAHA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans p-6 md:p-12 text-gray-800">

    <!-- Container Utama Lembar Nota Kuitansi -->
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-sm border border-gray-200 relative overflow-hidden">

        <!-- Watermark Lunas -->
        <div class="absolute top-20 right-10 transform rotate-12 opacity-10 pointer-events-none select-none hidden md:block">
            <p class="text-emerald-600 font-black text-8xl border-8 border-emerald-600 p-4 rounded-3xl tracking-widest">LUNAS</p>
        </div>

        <!-- Header Kuitansi -->
        <div class="flex justify-between items-start border-b pb-6 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-black text-[#1E3A8A] flex items-center tracking-wider">
                    <i class="fa-solid fa-house-chimney text-teal-500 mr-2"></i>GRAHA KOS
                </h1>
                <p class="text-xs text-gray-400 mt-1">Sistem Manajemen Kelola Kos Modern Digital</p>
            </div>
            <div class="text-right">
                <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-receipt mr-1"></i> Bukti Bayar Sah
                </span>
                <p class="text-xs text-gray-500 mt-2">No. Kuitansi: <span class="font-mono font-bold text-gray-700">GRH-2026-00{{ $billing->id }}</span></p>
            </div>
        </div>

        <!-- Data Transaksi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-6 text-sm border-b">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Telah Diterima Dari:</h3>
                <p class="font-extrabold text-gray-800 text-base">{{ Auth::user()->name }}</p>
                <p class="text-gray-500 text-xs mt-0.5">Email Pengguna: {{ Auth::user()->email }}</p>
            </div>
            <div class="md:text-right">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Pembayaran:</h3>
                <p class="font-bold text-gray-700">{{ \Carbon\Carbon::parse($billing->updated_at)->format('d F Y - H:i') }} WITA</p>
                <p class="text-xs text-gray-400 mt-1">Metode: E-Payment Digital</p>
            </div>
        </div>

        <!-- Detail Kamar Kos -->
        <div class="py-6 border-b">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Rincian Alokasi Properti:</h3>
            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex justify-between items-center flex-wrap gap-2 text-sm">
                <div>
                    <p class="font-bold text-[#1E3A8A] text-base">{{ $billing->property->name }}</p>
                    <p class="text-xs text-gray-500 mt-1"><i class="fa-solid fa-location-dot text-red-400 mr-1"></i> {{ $billing->property->location ?? 'Denpasar, Bali' }}</p>
                </div>
                <div class="text-right">
                    <span class="bg-teal-50 text-teal-700 text-xs font-bold px-2.5 py-1 rounded-md border border-teal-100">
                        Kos {{ ucfirst($billing->property->type ?? 'Putri') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Rincian Nominal Angka Pembayaran -->
        <div class="py-6 space-y-4">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Sewa Kamar Utama (Periode Pertama)</span>
                <span class="font-semibold text-gray-800">Rp {{ number_format($billing->amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Biaya Admin & Pemeliharaan Aplikasi</span>
                <span class="font-semibold text-emerald-600">Gratis (Free)</span>
            </div>

            <div class="pt-4 border-t flex justify-between items-center">
                <span class="text-base font-bold text-gray-800">Total Terbayar:</span>
                <span class="text-2xl font-black text-teal-600">Rp {{ number_format($billing->amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer Nota & Tanda Tangan Digital -->
        <div class="mt-8 pt-6 border-t border-dashed flex justify-between items-center text-xs text-gray-400 flex-wrap gap-4">
            <div>
                <p>*Kuitansi ini diterbitkan secara elektronik oleh sistem komputer GRAHA dan sah tanpa tanda tangan fisik.</p>
            </div>
            <div class="no-print">
                <button onclick="window.print()" class="bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all flex items-center">
                    <i class="fa-solid fa-print mr-2"></i> Cetak Dokumen Ini
                </button>
            </div>
        </div>

    </div>

    <!-- Gaya CSS khusus agar saat dicetak kertas, tombol dan background abu-abu luarnya menghilang otomatis -->
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; p: 0 !important; }
            .max-w-3xl { border: none !important; shadow: none !important; }
        }
    </style>
</body>
</html>
