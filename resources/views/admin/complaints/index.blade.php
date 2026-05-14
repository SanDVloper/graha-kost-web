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

            <a href="{{ route('admin.kost.detail') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>

            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-medium ml-3">Transaksi</span>
            </a>

            <a href="#" class="flex items-center justify-between px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
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
    <!-- MAIN WRAPPER (biar konsisten kayak enrollment) -->
<div class="flex-1 flex flex-col h-full overflow-hidden">

    <!-- TOPBAR -->
    <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">

        <div class="flex items-center font-bold text-xl text-[#1e3a5f]">
            <i class="fa-solid fa-triangle-exclamation mr-3 text-[#38a38e]"></i>
            Data Komplain
        </div>

    </header>

    <!-- SCROLLABLE CONTENT -->
    <div class="flex-1 overflow-y-auto p-8">

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- KOLOM KIRI -->
            <div class="xl:col-span-1 space-y-6">

                <!-- TOTAL -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500">Total Komplain</p>
                    <h2 class="text-3xl font-bold text-[#1e3a5f] mt-2">
                        {{ count($complaints) }}
                    </h2>
                </div>

                <!-- STATUS -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-3">

                    <h3 class="font-bold text-[#1e3a5f] mb-2">Status Komplain</h3>

                    <div class="flex justify-between text-sm">
                        <span>Pending</span>
                        <span class="font-bold text-yellow-600">
                            {{ $complaints->where('status','pending')->count() }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Proses</span>
                        <span class="font-bold text-blue-600">
                            {{ $complaints->where('status','proses')->count() }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Selesai</span>
                        <span class="font-bold text-green-600">
                            {{ $complaints->where('status','selesai')->count() }}
                        </span>
                    </div>

                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div class="xl:col-span-2">

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <!-- HEADER TABLE -->
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">

                        <h3 class="font-bold text-lg text-[#1e3a5f]">
                            Daftar Komplain
                        </h3>

                        <input type="text"
                               placeholder="Cari komplain..."
                               class="px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#38a38e]">

                    </div>

                    <!-- TABLE -->
                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-white border-b text-gray-500">
                                <tr>
                                    <th class="py-4 px-6 text-left">User</th>
                                    <th class="py-4 px-6 text-left">Judul</th>
                                    <th class="py-4 px-6 text-left">Status</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($complaints as $complaint)

                                <tr class="border-b hover:bg-gray-50 transition">

                                    <td class="py-4 px-6">
                                        <div class="font-bold text-[#1e3a5f]">
                                            {{ $complaint->user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $complaint->user->email }}
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 text-gray-700">
                                        {{ $complaint->judul }}
                                    </td>

                                    <td class="py-4 px-6">

                                        @if($complaint->status == 'pending')
                                            <span class="bg-yellow-50 text-yellow-600 border border-yellow-200 px-3 py-1 rounded-full text-xs font-bold">
                                                Pending
                                            </span>

                                        @elseif($complaint->status == 'proses')
                                            <span class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1 rounded-full text-xs font-bold">
                                                Proses
                                            </span>

                                        @else
                                            <span class="bg-green-50 text-green-600 border border-green-200 px-3 py-1 rounded-full text-xs font-bold">
                                                Selesai
                                            </span>
                                        @endif

                                    </td>

                                    <td class="py-4 px-6 text-center">

                                        <form action="{{ route('complaints.updateStatus', $complaint->id) }}"
                                              method="POST"
                                              class="flex justify-center gap-2">

                                            @csrf
                                            @method('PUT')

                                            <select name="status"
                                                    class="border rounded-lg px-2 py-1 text-sm">

                                                <option value="pending">Pending</option>
                                                <option value="proses">Proses</option>
                                                <option value="selesai">Selesai</option>

                                            </select>

                                            <button type="submit"
                                                    class="bg-[#38a38e] hover:bg-teal-700 text-white px-3 py-1 rounded text-xs font-bold">
                                                Update
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="4" class="text-center py-10 text-gray-500">
                                        Belum ada komplain
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

</script>

</body>
</html>