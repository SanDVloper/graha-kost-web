<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Enrollment - Admin GRAHA</title>
    
    <!-- MENGGUNAKAN STANDAR GRAHA: Vite, FontAwesome, dan Font Inter -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery untuk logika form -->
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
            
            <!-- Menu Enrollment/Verifikasi (Active) -->
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-user-check"></i></div>
                <span class="font-bold ml-3">Enrollment</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-users"></i></div>
                <span class="font-medium ml-3">Pengguna</span>
            </a>

            <a href="{{ route('admin.detail') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>

            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-medium ml-3">Transaksi</span>
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
                <i class="fa-solid fa-user-check mr-3 text-[#38a38e]"></i> Pengajuan Enrollment
            </div>

            <div class="flex items-center gap-6">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#38a38e] font-bold text-sm transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- SCROLLABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <!-- KOLOM KIRI: FORM CARD -->
                <div class="xl:col-span-1">
                    <div class="bg-white p-6 md:p-8 rounded-xl border border-gray-200 shadow-sm">
                        
                        <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                            <i class="fa-solid fa-file-signature text-teal-600 mr-3"></i> Formulir Enrollment
                        </h3>

                        <!-- Alert Box (Hidden by default) -->
                        <div id="alert" class="hidden mb-6 px-4 py-3 rounded-lg text-sm flex items-center gap-2 border">
                            <i class="fa-solid fa-circle-info mt-0.5"></i>
                            <span id="alert-text"></span>
                        </div>

                        <form id="enrollForm" class="space-y-5">

                            <!-- Nama -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" required
                                       class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors"
                                       placeholder="Masukkan nama lengkap">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" required
                                       class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors"
                                       placeholder="Masukkan email valid">
                            </div>

                            <!-- Role -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Pengguna</label>
                                <select name="role" required
                                        class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors appearance-none">
                                    <option value="" disabled selected>-- Pilih Tipe --</option>
                                    <option value="owner">Pemilik Kost</option>
                                    <option value="admin">Admin Aplikasi</option>
                                    <option value="user">User / Pencari Kost</option>
                                </select>
                            </div>

                            <!-- Kost -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kost <span class="text-xs font-normal text-gray-400">(Khusus Pemilik)</span></label>
                                <input type="text" name="property"
                                       class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors"
                                       placeholder="Contoh: Kost Graha">
                            </div>

                            <!-- Dokumen -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Upload Dokumen Identitas</label>
                                <input type="file" name="document"
                                       class="w-full bg-slate-50 border border-gray-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-[#38a38e] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-[#38a38e] hover:file:bg-teal-100 transition-colors">
                            </div>

                            <!-- Catatan -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Tambahan</label>
                                <textarea name="note" rows="3"
                                          class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-[#38a38e] focus:bg-white transition-colors"
                                          placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                            </div>

                            <!-- BUTTON -->
                            <div class="flex justify-end gap-3 pt-2">
                                <button type="reset" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Reset
                                </button>
                                <button type="submit" class="px-5 py-2.5 bg-[#38a38e] hover:bg-teal-700 text-white font-bold text-sm rounded-lg shadow-sm transition-colors">
                                    Ajukan Data
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- KOLOM KANAN: LIST PENGAJUAN -->
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm h-full flex flex-col">
                        
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-bold text-lg text-[#1e3a5f]">Daftar Antrean Pengajuan</h3>
                            <div class="relative">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Cari nama..." class="pl-9 pr-4 py-1.5 bg-white border border-gray-200 rounded-lg text-sm focus:border-[#38a38e] focus:outline-none transition-colors w-48">
                            </div>
                        </div>

                        <div class="flex-1 overflow-x-auto">
                            <table class="w-full text-left text-sm whitespace-nowrap">
                                <thead class="bg-white border-b border-gray-200 text-gray-500">
                                    <tr>
                                        <th class="py-4 px-6 font-semibold">Nama / Email</th>
                                        <th class="py-4 px-6 font-semibold">Tipe (Role)</th>
                                        <th class="py-4 px-6 font-semibold">Status</th>
                                        <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-[#1e3a5f]">Budi Santoso</div>
                                            <div class="text-xs text-gray-500">budi@mail.com</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center gap-1.5">
                                                <i class="fa-solid fa-crown text-yellow-500 text-xs"></i> Pemilik Kost
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="bg-yellow-50 text-yellow-600 border border-yellow-200 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Menunggu</span>
                                        </td>
                                        <td class="py-4 px-6 text-center space-x-2">
                                            <button class="bg-green-50 hover:bg-green-500 text-green-600 hover:text-white border border-green-200 hover:border-green-500 px-3 py-1.5 rounded text-xs font-bold transition-colors" title="Setujui">
                                                <i class="fa-solid fa-check mr-1"></i> Approve
                                            </button>
                                            <button class="bg-red-50 hover:bg-red-500 text-red-600 hover:text-white border border-red-200 hover:border-red-500 px-3 py-1.5 rounded text-xs font-bold transition-colors" title="Tolak">
                                                <i class="fa-solid fa-xmark mr-1"></i> Reject
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Contoh Data Lolos -->
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors opacity-60">
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-[#1e3a5f]">Siti Aminah</div>
                                            <div class="text-xs text-gray-500">siti.ami@mail.com</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center gap-1.5">
                                                <i class="fa-solid fa-user text-blue-400 text-xs"></i> User Biasa
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="bg-green-50 text-green-600 border border-green-200 font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Disetujui</span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="text-xs text-gray-400 italic">Selesai</span>
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
    $('#enrollForm').submit(function(e){
        e.preventDefault();
        showAlert("Pengajuan enrollment berhasil dikirim ke sistem!", "success");
        // Reset form setelah sukses
        this.reset();
    });

    function showAlert(msg, type){
        let alertBox = $('#alert');
        let alertText = $('#alert-text');
        
        // Reset class
        alertBox.removeClass('bg-green-50 border-green-200 text-green-700 bg-red-50 border-red-200 text-red-700 hidden');
        
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