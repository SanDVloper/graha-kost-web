<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran - Admin GRAHA</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- MENGGUNAKAN STANDAR GRAHA: Vite, FontAwesome, dan Font Inter -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR GRAHA STYLE -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col transition-[width] duration-300 relative z-20 shrink-0">
        <div class="h-20 flex items-center px-6 border-b border-gray-200 overflow-hidden">
            <div class="mr-3 shrink-0 w-10"><img src="{{ asset('assets/logograha.png') }}" alt="Logo GRAHA" class="w-full h-auto"></div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl text-[#1e3a5f]">GRAHA</h1>
                <p class="text-[0.6rem] text-[#38a38e] font-semibold uppercase tracking-wider">Super Admin</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg mb-2 transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-user-check"></i></div>
                <span class="font-medium ml-3">Verifikasi Akun</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-users"></i></div>
                <span class="font-medium ml-3">Pengguna</span>
            </a>

            <a href="{{ route('admin.kost.detail') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>

            <!-- Menu Transaksi (Active karena ini bagian dari Tagihan/Transaksi) -->
            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-bold ml-3">Transaksi</span>
            </a>

            <a href="{{ route('admin.complaints.index') }}" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="flex items-center">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <span class="font-medium ml-3">Komplain</span>
                </div>
                <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">5</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-file-lines"></i></div>
                <span class="font-medium ml-3">Laporan</span>
            </a>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4">System</div>
            
            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="font-medium ml-3">Pengaturan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center px-4 py-2">
                <div class="w-8 h-8 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold mr-3 text-xs">GP</div>
                <div>
                    <p class="font-bold text-sm text-slate-800">Guntur Putra</p>
                    <p class="text-xs text-gray-400">Super Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">

        <!-- TOPBAR -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
                <i class="fa-solid fa-cash-register mr-3 text-[#38a38e]"></i> Proses Pembayaran
            </div>

            <div class="flex items-center gap-6">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#38a38e] font-bold text-sm transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Tagihan
                </a>
            </div>
        </header>

        <!-- SCROLLABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <!-- KOLOM KIRI: INFO & FORM PEMBAYARAN -->
                <div class="xl:col-span-1 space-y-6">
                    
                    <!-- INFO TAGIHAN CARD -->
                    <div class="bg-white p-6 md:p-8 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="font-bold text-lg text-[#1e3a5f] mb-4 flex items-center border-b border-gray-100 pb-3">
                            <i class="fa-solid fa-file-invoice text-teal-600 mr-3"></i> Detail Tagihan
                        </h3>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-dashed border-gray-200 pb-2">
                                <span class="text-sm text-gray-500">Nama Penghuni</span>
                                <span class="font-bold text-slate-800">Budi Santoso</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-dashed border-gray-200 pb-2">
                                <span class="text-sm text-gray-500">Kamar</span>
                                <span class="font-bold text-slate-800">Kamar A1</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-dashed border-gray-200 pb-2">
                                <span class="text-sm text-gray-500">Periode</span>
                                <span class="font-bold text-slate-800">Mei 2026</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-dashed border-gray-200 pb-2">
                                <span class="text-sm text-gray-500">Total Tagihan</span>
                                <span class="font-bold text-slate-800">Rp 1.000.000</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-dashed border-gray-200 pb-2">
                                <span class="text-sm text-gray-500">Sudah Dibayar</span>
                                <span class="font-bold text-green-600">Rp 500.000</span>
                            </div>
                            <div class="flex justify-between items-center bg-red-50 p-3 rounded-lg border border-red-100">
                                <span class="text-sm font-bold text-red-500">Sisa Tagihan</span>
                                <span class="font-bold text-red-600 text-lg">Rp 500.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- FORM PEMBAYARAN CARD -->
                    <div class="bg-white p-6 md:p-8 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="font-bold text-lg text-[#1e3a5f] mb-4 flex items-center border-b border-gray-100 pb-3">
                            <i class="fa-solid fa-wallet text-teal-600 mr-3"></i> Input Pembayaran Baru
                        </h3>

                        <!-- Alert Box (Hidden by default) -->
                        <div id="alert" class="hidden mb-6 px-4 py-3 rounded-lg text-sm flex items-center gap-2 border">
                            <i class="fa-solid fa-circle-info mt-0.5"></i>
                            <span id="alert-text"></span>
                        </div>

                        <form id="paymentForm" class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Bayar</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-200 bg-gray-50 text-gray-500 text-sm font-bold">Rp</span>
                                    <input type="number" name="amount" required
                                           class="w-full bg-slate-50 border border-gray-200 rounded-r-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors"
                                           placeholder="Contoh: 500000">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Metode Pembayaran</label>
                                <select name="method" required
                                        class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors appearance-none">
                                    <option value="" disabled selected>-- Pilih Metode --</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Tunai (Cash)</option>
                                    <option value="ewallet">E-Wallet (GoPay/OVO)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pembayaran</label>
                                <input type="date" name="date" required
                                       class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors">
                            </div>

                            <button type="submit" class="w-full px-5 py-3 bg-[#38a38e] hover:bg-teal-700 text-white font-bold text-sm rounded-lg shadow-sm transition-transform transform hover:-translate-y-0.5 mt-2 flex justify-center items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan Pembayaran
                            </button>
                        </form>
                    </div>

                </div>

                <!-- KOLOM KANAN: RIWAYAT PEMBAYARAN -->
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm h-full flex flex-col">
                        
                        <div class="p-6 border-b border-gray-200 bg-gray-50/50 flex items-center gap-3">
                            <i class="fa-solid fa-clock-rotate-left text-gray-400"></i>
                            <h3 class="font-bold text-lg text-[#1e3a5f]">Riwayat Cicilan / Pembayaran</h3>
                        </div>

                        <div class="flex-1 overflow-x-auto p-6">
                            <table class="w-full text-left text-sm whitespace-nowrap">
                                <thead class="bg-slate-50 border-y border-gray-200 text-gray-500">
                                    <tr>
                                        <th class="py-4 px-4 font-semibold">Tanggal & Waktu</th>
                                        <th class="py-4 px-4 font-semibold">Nominal Masuk</th>
                                        <th class="py-4 px-4 font-semibold">Metode</th>
                                        <th class="py-4 px-4 font-semibold">Diterima Oleh</th>
                                        <th class="py-4 px-4 font-semibold text-center">Status</th>
                                        <th class="py-4 px-4 font-semibold text-center">Struk</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="font-bold text-[#1e3a5f]">01 Mei 2026</div>
                                            <div class="text-[10px] text-gray-400">10:30 WITA</div>
                                        </td>
                                        <td class="py-4 px-4 font-bold text-green-600">Rp 500.000</td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center gap-1.5 text-slate-600">
                                                <i class="fa-solid fa-building-columns text-gray-400 text-xs"></i> Transfer Bank
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 font-medium text-slate-600">Sistem / Admin</td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="bg-green-50 text-green-600 border border-green-200 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Valid</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <button class="text-gray-400 hover:text-[#38a38e] transition-colors" title="Cetak Kwitansi"><i class="fa-solid fa-print"></i></button>
                                        </td>
                                    </tr>

                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="font-bold text-[#1e3a5f]">03 Mei 2026</div>
                                            <div class="text-[10px] text-gray-400">14:15 WITA</div>
                                        </td>
                                        <td class="py-4 px-4 font-bold text-green-600">Rp 500.000</td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center gap-1.5 text-slate-600">
                                                <i class="fa-solid fa-wallet text-gray-400 text-xs"></i> Cash (Tunai)
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 font-medium text-slate-600">Guntur Putra</td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="bg-green-50 text-green-600 border border-green-200 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Valid</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <button class="text-gray-400 hover:text-[#38a38e] transition-colors" title="Cetak Kwitansi"><i class="fa-solid fa-print"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

<script>
$(document).ready(function(){
    $('#paymentForm').submit(function(e){
        e.preventDefault();
        showAlert("Pembayaran berhasil disimpan dan dicatat dalam sistem!", "success");
        // Reset form setelah sukses
        this.reset();
    });

    // Fungsi notifikasi agar sesuai dengan class Tailwind GRAHA
    function showAlert(msg, type){
        let alertBox = $('#alert');
        let alertText = $('#alert-text');
        
        // Bersihkan class lama
        alertBox.removeClass('bg-green-50 border-green-200 text-green-700 bg-red-50 border-red-200 text-red-700 hidden');
        
        // Tambahkan class baru sesuai status
        if(type === 'success') {
            alertBox.addClass('bg-green-50 border-green-200 text-green-700');
        } else {
            alertBox.addClass('bg-red-50 border-red-200 text-red-700');
        }

        alertText.text(msg);
        alertBox.fadeIn().delay(3000).fadeOut();
    }
});
</script>

</body>
</html>