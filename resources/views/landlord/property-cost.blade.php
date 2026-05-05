<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Cost & Type - GRAHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        input:disabled { background-color: #f8fafc; cursor: not-allowed; }
    </style>
</head>
<body class="bg-[#f4f7f6] text-slate-800 min-h-screen flex flex-col pb-24">

    <!-- TOP NAVIGATION BAR -->
    <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-6">
            <a href="{{ url('/add-property') }}" class="text-gray-500 hover:text-[#38a38e] transition-colors text-xl">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#1e3a5f]">New Property Registration</h1>
                <p class="text-sm text-gray-500 mt-0.5">Step 2 of 3</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="text-slate-500 font-bold text-lg hover:text-red-500 transition-colors">
            Cancel
        </a>
    </header>

    <!-- PROGRESS BAR SECTION -->
    <div class="max-w-4xl mx-auto px-6 w-full pt-12 pb-8">
        <div class="relative px-10">
            <div class="absolute top-1/2 left-0 w-full h-1.5 bg-gray-200 -translate-y-4 rounded-full z-0"></div>
            <div class="absolute top-1/2 left-0 w-2/3 h-1.5 bg-[#38a38e] -translate-y-4 rounded-full z-0 transition-all duration-500"></div>

            <div class="relative z-10 flex justify-between">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-white">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-sm font-bold text-[#38a38e]">Property Profile</span>
                </div>
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-white">2</div>
                    <span class="text-sm font-bold text-[#38a38e]">Property Cost and Type</span>
                </div>
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white text-gray-400 flex items-center justify-center font-bold text-xl shadow-md border-4 border-gray-200">3</div>
                    <span class="text-sm font-semibold text-gray-400">Ready to Publish!</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <main class="max-w-4xl mx-auto px-6 w-full flex-1">
        
        <div class="flex items-center justify-between mb-6 mt-4">
            <div>
                <h2 class="text-2xl font-bold text-[#1e3a5f]">Tipe Kamar Pertama</h2>
                <p class="text-gray-500 text-sm mt-1">Anda dapat menambahkan tipe kamar lainnya (misal: VIP) nanti.</p>
            </div>
            <span class="px-4 py-1.5 bg-teal-50 text-[#38a38e] text-xs font-bold rounded-full border border-teal-100">TIPE 1</span>
        </div>

        <!-- FORM DIMULAI DI SINI -->
        <form action="{{ url('/property-cost/' . $id) }}" method="POST">
            @csrf <!-- Wajib -->

            <!-- Card 1: Detail Kamar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-[#38a38e]"></div>
                <h3 class="text-xl font-bold text-[#1e3a5f] mb-6">A. Spesifikasi Fisik</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Nama Tipe Kamar <span class="text-red-500">*</span></label>
                        <input type="text" name="room_name" class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" placeholder="Misal: Standard Non-AC, Kamar VIP..." required>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Ukuran <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" name="room_size" class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 pr-10 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" placeholder="3 x 4" required>
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">m²</span>
                            </div>
                        </div>
                        <div class="w-24">
                            <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Jumlah</label>
                            <input type="number" name="room_quantity" class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 text-center text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" value="1" min="1" required>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2 mt-2">
                        <label class="block text-sm font-bold text-[#1e3a5f] mb-3">Fasilitas Dalam Kamar</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Array checkbox dengan name="room_facilities[]" -->
                            <label class="cursor-pointer room-facility">
                                <input type="checkbox" name="room_facilities[]" value="Kasur" class="sr-only peer hidden-checkbox">
                                <div class="facility-box rounded-xl border-2 border-transparent bg-[#f4f5f7] p-4 flex items-center transition-all peer-checked:border-[#38a38e] peer-checked:bg-teal-50">
                                    <i class="fa-solid fa-bed text-gray-400 w-6 text-center text-lg icon-fac"></i>
                                    <span class="text-sm font-semibold text-gray-500 ml-2 text-fac">Kasur</span>
                                </div>
                            </label>
                            <label class="cursor-pointer room-facility">
                                <input type="checkbox" name="room_facilities[]" value="K. Mandi Dalam" class="sr-only peer hidden-checkbox">
                                <div class="facility-box rounded-xl border-2 border-transparent bg-[#f4f5f7] p-4 flex items-center transition-all peer-checked:border-[#38a38e] peer-checked:bg-teal-50">
                                    <i class="fa-solid fa-bath text-gray-400 w-6 text-center text-lg icon-fac"></i>
                                    <span class="text-sm font-semibold text-gray-500 ml-2 text-fac">K. Mandi</span>
                                </div>
                            </label>
                            <label class="cursor-pointer room-facility">
                                <input type="checkbox" name="room_facilities[]" value="AC" class="sr-only peer hidden-checkbox">
                                <div class="facility-box rounded-xl border-2 border-transparent bg-[#f4f5f7] p-4 flex items-center transition-all peer-checked:border-[#38a38e] peer-checked:bg-teal-50">
                                    <i class="fa-regular fa-snowflake text-gray-400 w-6 text-center text-lg icon-fac"></i>
                                    <span class="text-sm font-semibold text-gray-500 ml-2 text-fac">AC</span>
                                </div>
                            </label>
                            <label class="cursor-pointer room-facility">
                                <input type="checkbox" name="room_facilities[]" value="Lemari" class="sr-only peer hidden-checkbox">
                                <div class="facility-box rounded-xl border-2 border-transparent bg-[#f4f5f7] p-4 flex items-center transition-all peer-checked:border-[#38a38e] peer-checked:bg-teal-50">
                                    <i class="fa-solid fa-door-closed text-gray-400 w-6 text-center text-lg icon-fac"></i>
                                    <span class="text-sm font-semibold text-gray-500 ml-2 text-fac">Lemari</span>
                                </div>
                            </label>
                            <label class="cursor-pointer room-facility">
                                <input type="checkbox" name="room_facilities[]" value="TV" class="sr-only peer hidden-checkbox">
                                <div class="facility-box rounded-xl border-2 border-transparent bg-[#f4f5f7] p-4 flex items-center transition-all peer-checked:border-[#38a38e] peer-checked:bg-teal-50">
                                    <i class="fa-solid fa-tv text-gray-400 w-6 text-center text-lg icon-fac"></i>
                                    <span class="text-sm font-semibold text-gray-500 ml-2 text-fac">TV</span>
                                </div>
                            </label>
                            <label class="cursor-pointer room-facility">
                                <input type="checkbox" name="room_facilities[]" value="Water Heater" class="sr-only peer hidden-checkbox">
                                <div class="facility-box rounded-xl border-2 border-transparent bg-[#f4f5f7] p-4 flex items-center transition-all peer-checked:border-[#38a38e] peer-checked:bg-teal-50">
                                    <i class="fa-solid fa-hot-tub-person text-gray-400 w-6 text-center text-lg icon-fac"></i>
                                    <span class="text-sm font-semibold text-gray-500 ml-2 text-fac">Water Heater</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Skema Durasi Sewa -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-[#1e3a5f]"></div>
                
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-[#1e3a5f] mb-1">B. Skema Harga & Durasi</h3>
                        <p class="text-sm text-gray-500">Aktifkan durasi sewa yang Anda izinkan untuk tipe kamar ini.</p>
                    </div>
                    <div class="bg-slate-100 text-slate-600 p-2.5 rounded-lg text-xs font-bold hidden sm:block border border-gray-200">
                        <i class="fa-solid fa-circle-info mr-1 text-[#38a38e]"></i> Harga Pokok (Belum Utilitas)
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Harga Bulanan -->
                    <div class="price-row flex flex-col sm:flex-row sm:items-center justify-between p-5 border-2 border-[#38a38e] bg-teal-50/50 rounded-xl gap-4 transition-all">
                        <div class="flex items-center">
                            <input type="checkbox" checked class="price-toggle w-5 h-5 accent-[#38a38e] rounded cursor-pointer">
                            <label class="ml-3 font-bold text-[#1e3a5f]">Sewa Bulanan</label>
                        </div>
                        <div class="relative w-full sm:w-64">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                            <input type="text" name="price_monthly" class="price-input format-rp w-full bg-white border border-gray-300 rounded-lg py-3 pl-12 pr-12 text-right font-bold text-[#1e3a5f] focus:outline-none focus:border-[#38a38e] transition-colors" placeholder="0">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-semibold text-xs">/ bln</span>
                        </div>
                    </div>

                    <!-- Harga Harian -->
                    <div class="price-row flex flex-col sm:flex-row sm:items-center justify-between p-5 border-2 border-transparent bg-[#f4f5f7] rounded-xl gap-4 transition-all">
                        <div class="flex items-center">
                            <input type="checkbox" class="price-toggle w-5 h-5 accent-[#38a38e] rounded cursor-pointer">
                            <label class="ml-3 font-bold text-gray-500">Sewa Harian</label>
                        </div>
                        <div class="relative w-full sm:w-64 opacity-50 input-wrapper">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                            <input type="text" name="price_daily" class="price-input format-rp w-full bg-white border border-gray-300 rounded-lg py-3 pl-12 pr-12 text-right font-bold text-[#1e3a5f] focus:outline-none focus:border-[#38a38e] transition-colors" placeholder="0" disabled>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-semibold text-xs">/ hari</span>
                        </div>
                    </div>

                    <!-- Harga Tahunan -->
                    <div class="price-row flex flex-col sm:flex-row sm:items-center justify-between p-5 border-2 border-transparent bg-[#f4f5f7] rounded-xl gap-4 transition-all">
                        <div class="flex items-center">
                            <input type="checkbox" class="price-toggle w-5 h-5 accent-[#38a38e] rounded cursor-pointer">
                            <label class="ml-3 font-bold text-gray-500">Sewa Tahunan</label>
                        </div>
                        <div class="relative w-full sm:w-64 opacity-50 input-wrapper">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                            <input type="text" name="price_yearly" class="price-input format-rp w-full bg-white border border-gray-300 rounded-lg py-3 pl-12 pr-12 text-right font-bold text-[#1e3a5f] focus:outline-none focus:border-[#38a38e] transition-colors" placeholder="0" disabled>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-semibold text-xs">/ thn</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Manajemen Tagihan Utilitas -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-orange-400"></div>
                
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-[#1e3a5f] mb-1">C. Biaya Utilitas & Tambahan</h3>
                    <p class="text-sm text-gray-500">Pengaturan ini akan otomatis digabungkan ke <strong class="text-[#1e3a5f]">Billing System</strong> saat penagihan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Listrik -->
                    <div class="bg-[#f4f5f7] p-6 rounded-xl border border-transparent">
                        <h4 class="font-bold text-[#1e3a5f] mb-5 flex items-center text-lg">
                            <i class="fa-solid fa-bolt text-yellow-500 mr-3"></i> Tagihan Listrik
                        </h4>
                        <div class="space-y-4">
                            <label class="flex items-start cursor-pointer group">
                                <input type="radio" name="listrik" value="include" class="mt-1 w-4 h-4 accent-[#38a38e]" checked>
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-[#1e3a5f] group-hover:text-[#38a38e] transition-colors">Termasuk Harga Sewa</span>
                                </div>
                            </label>
                            <label class="flex items-start cursor-pointer group">
                                <input type="radio" name="listrik" value="meteran" class="mt-1 w-4 h-4 accent-[#38a38e]">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-[#1e3a5f] group-hover:text-[#38a38e] transition-colors">Tagihan Terpisah (Meteran)</span>
                                </div>
                            </label>
                            <label class="flex items-start cursor-pointer group">
                                <input type="radio" name="listrik" value="token" class="mt-1 w-4 h-4 accent-[#38a38e]">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-[#1e3a5f] group-hover:text-[#38a38e] transition-colors">Sistem Token Sendiri</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Air -->
                    <div class="bg-[#f4f5f7] p-6 rounded-xl border border-transparent">
                        <h4 class="font-bold text-[#1e3a5f] mb-5 flex items-center text-lg">
                            <i class="fa-solid fa-droplet text-blue-500 mr-3"></i> Tagihan Air
                        </h4>
                        <div class="space-y-5">
                            <label class="flex items-start cursor-pointer group">
                                <input type="radio" name="air" value="include" class="mt-1.5 w-4 h-4 accent-[#38a38e]" checked>
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-[#1e3a5f] group-hover:text-[#38a38e] transition-colors">Termasuk Harga Sewa</span>
                                </div>
                            </label>
                            <label class="flex items-start cursor-pointer group">
                                <input type="radio" name="air" value="flat" class="mt-2.5 w-4 h-4 accent-[#38a38e]">
                                <div class="ml-3 w-full pr-4">
                                    <span class="block text-sm font-bold text-[#1e3a5f] mb-2 group-hover:text-[#38a38e] transition-colors">Ditagih Flat Bulanan</span>
                                    <div class="relative w-full">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                                        <input type="text" name="water_price" id="air-flat-input" class="format-rp w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 pl-12 text-sm text-slate-700 focus:outline-none focus:border-[#38a38e] transition-colors opacity-50" placeholder="Misal: 50.000" disabled>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Deposit -->
                    <div class="col-span-1 md:col-span-2 border-t border-gray-200 pt-6 mt-2">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h4 class="font-bold text-[#1e3a5f] mb-1 text-lg">Uang Jaminan (Deposit)</h4>
                                <p class="text-sm text-gray-500">Ditagihkan 1x saat awal masuk, dikembalikan saat keluar.</p>
                            </div>
                            <div class="relative w-full sm:w-64">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                                <input type="text" name="deposit" class="format-rp w-full bg-[#f4f5f7] border border-transparent rounded-lg py-3 pl-12 pr-4 text-right font-bold text-[#1e3a5f] focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit (Diubah dari link a href ke button submit) -->
            <!-- Bottom Action Bar (Fixed) -->
            <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-5 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)] z-40">
                <div class="max-w-4xl mx-auto flex items-center justify-between px-2">
                    <a href="{{ url('/add-property') }}" class="px-6 py-3.5 bg-white text-gray-600 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="px-8 py-3.5 bg-[#38a38e] text-white font-bold text-lg rounded-xl hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition-transform transform hover:-translate-y-0.5 flex items-center">
                        Save & Next Step
                        <i class="fa-solid fa-arrow-right ml-3"></i>
                    </button>
                </div>
            </div>
        </form>
    </main>

    <!-- LOGIKA JQUERY -->
    <!-- LOGIKA JQUERY -->
    <script type="module">
        $(document).ready(function() {
            
            // 1. Logika Warna Ikon & Teks Fasilitas (Klik ganda sudah dihilangkan)
            $('.room-facility input[type="checkbox"]').change(function() {
                let box = $(this).siblings('.facility-box');
                let icon = box.find('.icon-fac');
                let text = box.find('.text-fac');

                if($(this).is(':checked')) {
                    icon.removeClass('text-gray-400').addClass('text-[#38a38e]');
                    text.removeClass('text-gray-500').addClass('text-[#38a38e]');
                } else {
                    icon.removeClass('text-[#38a38e]').addClass('text-gray-400');
                    text.removeClass('text-[#38a38e]').addClass('text-gray-500');
                }
            });

            // 2. Logika Disable/Enable Harga Berdasarkan Checkbox
            $('.price-toggle').change(function() {
                let row = $(this).closest('.price-row');
                let input = row.find('.price-input');
                let wrapper = row.find('.input-wrapper');
                let label = $(this).siblings('label');

                if($(this).is(':checked')) {
                    input.prop('disabled', false);
                    wrapper.removeClass('opacity-50');
                    row.removeClass('border-transparent bg-[#f4f5f7]').addClass('border-[#38a38e] bg-teal-50/50');
                    label.removeClass('text-gray-500').addClass('text-[#1e3a5f]');
                    input.focus();
                } else {
                    input.prop('disabled', true).val('');
                    wrapper.addClass('opacity-50');
                    row.removeClass('border-[#38a38e] bg-teal-50/50').addClass('border-transparent bg-[#f4f5f7]');
                    label.removeClass('text-[#1e3a5f]').addClass('text-gray-500');
                }
            });

            // 3. Logika Input Flat Tagihan Air
            $('input[name="air"]').change(function() {
                let flatInput = $('#air-flat-input');
                if ($(this).val() === 'flat') {
                    flatInput.prop('disabled', false).removeClass('opacity-50').focus();
                } else {
                    flatInput.prop('disabled', true).addClass('opacity-50').val('');
                }
            });

            // 4. Format Rupiah Otomatis saat mengetik
            $('.format-rp').on('input', function() {
                let value = $(this).val().replace(/[^,\d]/g, '').toString();
                let split = value.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                $(this).val(rupiah);
            });

        });
    </script>
</body>
</html>