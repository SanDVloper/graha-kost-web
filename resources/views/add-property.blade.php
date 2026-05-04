<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Property Registration - GRAHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- ... kode lainnya ... -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#f4f7f6] text-slate-800 min-h-screen flex flex-col">

    <!-- TOP NAVIGATION BAR -->
    <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-6">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-teal-600 transition-colors text-xl">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#1e3a5f]">New Property Registration</h1>
                <p class="text-sm text-gray-500 mt-0.5">Step 1 of 3</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="text-slate-500 font-bold text-lg hover:text-red-500 transition-colors">
            Cancel
        </a>
    </header>

    <!-- MAIN CONTENT SCROLLABLE AREA -->
    <main class="flex-1 overflow-y-auto pb-24">
        <div class="max-w-4xl mx-auto px-6">
            
            <!-- PROGRESS BAR SECTION -->
            <div class="py-12 relative px-10">
                <div class="absolute top-1/2 left-0 w-full h-1.5 bg-gray-200 -translate-y-4 rounded-full z-0"></div>
                <div class="absolute top-1/2 left-0 w-1/3 h-1.5 bg-[#38a38e] -translate-y-4 rounded-full z-0"></div>

                <div class="relative z-10 flex justify-between">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-white">1</div>
                        <span class="text-sm font-bold text-[#38a38e]">Property Profile</span>
                    </div>
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-[#f4f7f6]">2</div>
                        <span class="text-sm font-semibold text-gray-400">Property Cost and Type</span>
                    </div>
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-[#38a38e] text-white flex items-center justify-center font-bold text-xl shadow-md border-4 border-[#f4f7f6]">3</div>
                        <span class="text-sm font-semibold text-gray-400">Ready to Publish!</span>
                    </div>
                </div>
            </div>

            <!-- FORM SECTIONS (DIBUNGKUS TAG FORM) -->
            <form action="{{ url('/add-property') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                <!-- Wajib ada di Laravel untuk keamanan pengiriman data -->
                @csrf 
                
                <!-- CARD 1: Basic Information -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                    <h2 class="text-2xl font-bold text-[#1e3a5f] mb-8">New Property Registration</h2>
                    
                    <div class="space-y-6">
                        <!-- Property Name -->
                        <div>
                            <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Property Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" placeholder="Contoh: Kos Graha Indah">
                        </div>

                        <!-- Type & Year -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Property Type <span class="text-red-500">*</span></label>
                                <select name="type" required class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors appearance-none cursor-pointer">
                                    <option value="" disabled selected>Pilih Tipe Kos...</option>
                                    <option value="putra">Kos Putra</option>
                                    <option value="putri">Kos Putri</option>
                                    <option value="campur">Kos Campur</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Year of Establishment</label>
                                <input type="number" name="year_established" class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" placeholder="Contoh: 2020">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-bold text-[#1e3a5f] mb-2">Description</label>
                            <textarea name="description" rows="4" class="w-full bg-[#f4f5f7] border border-transparent rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors" placeholder="Ceritakan keunggulan kos Anda secara singkat..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Facilities -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-[#1e3a5f] mb-1">Facility</h2>
                        <p class="text-sm text-gray-500">Facilities that all residents can enjoy. Room amenities are arranged in the next step.</p>
                    </div>

                    <!-- Facility Grid -->
                    <div class="grid grid-cols-4 gap-4">
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <!-- Input hidden ditambahkan agar datanya terkirim -->
                            <input type="checkbox" name="facilities[]" value="WiFi" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-wifi text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">WiFi / Internet</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="Parkir Motor" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-motorcycle text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">Parkir Motor</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="Parkir Mobil" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-car text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">Parkir Mobil</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="Dapur Bersama" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-fire-burner text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">Dapur Bersama</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="CCTV" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-video text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">CCTV</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="Ruang Jemur" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-shirt text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">Ruang Jemur</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="Mesin Cuci" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-soap text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">Mesin Cuci</span>
                        </div>
                        <div class="facility-card cursor-pointer border-2 border-transparent bg-[#f4f5f7] hover:border-gray-300 rounded-xl p-5 flex flex-col items-center justify-center gap-3 transition-all relative">
                            <input type="checkbox" name="facilities[]" value="Penjaga Kos" class="hidden hidden-checkbox">
                            <i class="fa-solid fa-user-shield text-3xl text-gray-400 facility-icon"></i>
                            <span class="text-sm font-semibold text-gray-500 facility-text">Penjaga Kos</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Building Photos -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-[#1e3a5f] mb-1">Building Photos</h2>
                        <p class="text-sm text-gray-500">Upload photos of the front and common areas. (Format: JPG/PNG, Max. 5MB)</p>
                    </div>
                    <div id="preview-container" class="grid grid-cols-5 gap-4 mt-6">

                    </div>

                    <div id="upload-area" class="cursor-pointer border-2 border-dashed border-gray-300 bg-[#f4f5f7] hover:bg-gray-50 hover:border-[#38a38e] rounded-xl p-12 flex flex-col items-center justify-center transition-colors">
                        <div class="w-16 h-16 rounded-full bg-teal-100 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl text-[#38a38e]"></i>
                        </div>
                        <h3 class="text-[#1e3a5f] font-bold text-lg">Click or drag images here to upload</h3>
                        <p class="text-sm text-gray-400 mt-2">Maximum 5 photos allowed</p>
                        <!-- Atribut name ditambahkan pada input file -->
                        <input type="file" name="photos[]" id="file-input" class="hidden" multiple accept="image/png, image/jpeg">
                    </div>
                </div>

                <!-- Tombol Next diubah menjadi type="submit" -->
                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-[#38a38e] hover:bg-teal-700 text-white font-bold text-lg py-3 px-10 rounded-lg shadow-md transition-transform transform hover:-translate-y-0.5">
                        Next Step <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>

            </form>
        </div>
    </main>

    <!-- LOGIKA JQUERY -->
    <script type="module">
        $(document).ready(function() {
            
            // Logika Klik Kotak Fasilitas (Disempurnakan untuk backend)
            $('.facility-card').click(function() {
                let checkbox = $(this).find('.hidden-checkbox');
                let isActive = $(this).hasClass('border-[#38a38e]');
                
                if (!isActive) {
                    // Tampilan aktif
                    $(this).removeClass('border-transparent bg-[#f4f5f7] hover:border-gray-300').addClass('border-[#38a38e] bg-teal-50');
                    $(this).find('.facility-icon').removeClass('text-gray-400').addClass('text-[#38a38e]');
                    $(this).find('.facility-text').removeClass('text-gray-500').addClass('text-[#38a38e]');
                    // Centang input tersembunyi
                    checkbox.prop('checked', true);
                } else {
                    // Tampilan pasif
                    $(this).removeClass('border-[#38a38e] bg-teal-50').addClass('border-transparent bg-[#f4f5f7] hover:border-gray-300');
                    $(this).find('.facility-icon').removeClass('text-[#38a38e]').addClass('text-gray-400');
                    $(this).find('.facility-text').removeClass('text-[#38a38e]').addClass('text-gray-500');
                    // Hilangkan centang
                    checkbox.prop('checked', false);
                }
            });

            // 2. Logika Area Upload Foto & Preview
            $('#upload-area').click(function(e) {
                // Mencegah "pantulan klik" (infinite loop) yang bikin macet
                if (e.target.id !== 'file-input') {
                    $('#file-input').click();
                }
            });

            $('#file-input').change(function(e) {
                let files = e.target.files;
                let previewContainer = $('#preview-container');
                previewContainer.empty(); // Bersihkan preview lama

                if (files.length > 5) {
                    alert("Maksimal 5 foto saja, Tuanku!");
                    $(this).val('');
                    return;
                }

                // Loop untuk menampilkan setiap gambar yang dipilih
                $.each(files, function(i, file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        let html = `
                            <div class="relative group aspect-square rounded-xl overflow-hidden border border-gray-200">
                                <img src="${event.target.result}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                    <span class="text-white text-xs font-bold">Image ${i+1}</span>
                                </div>
                            </div>
                        `;
                        previewContainer.append(html);
                    };
                    reader.readAsDataURL(file);
                });
            });

        });
    </script>
</body>
</html>