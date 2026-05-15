<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komplain User - Admin GRAHA</title>
    
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
            
           
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">
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

              <!-- Menu Kost (Active) -->
            <a href="#"  class="flex items-center px-4 py-3 bg-teal-50 text-[#38a38e] rounded-lg transition-colors">
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
  
<div class="w-full h-screen flex flex-col bg-slate-50">

    <!-- HEADER -->
    <div class="px-6 py-4 border-b flex items-center justify-between bg-gray-50">
        <h2 class="font-bold text-[#1e3a5f]">
            Daftar Komplain
        </h2>

        <span class="text-xs text-gray-500">
            Total: {{ count($complaints) }}
        </span>
    </div>

    <!-- TABLE WRAPPER -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <thead class="bg-white border-b text-gray-500 sticky top-0 z-10">
                <tr>
                    <th class="text-left px-6 py-4">User</th>
                    <th class="text-left px-6 py-4">Keluhan</th>
                    <th class="text-left px-6 py-4">Priority</th>
                    <th class="text-left px-6 py-4">Status</th>
                    <th class="text-center px-6 py-4">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

            @forelse($complaints as $complaint)

                <tr class="hover:bg-gray-50 transition">

                    <!-- USER -->
                    <td class="px-6 py-4">
                        <div class="font-bold text-[#1e3a5f]">
                            {{ $complaint->user->name }}
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ $complaint->user->email }}
                        </div>
                    </td>

                    <!-- JUDUL -->
                    <td class="px-6 py-4 text-gray-700">
                        {{ $complaint->judul }}
                    </td>

                    <!-- PRIORITY -->
                    <td class="px-6 py-4">

                        @if($complaint->priority == 'high')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-50 text-red-600 border border-red-200">
                                High
                            </span>

                        @elseif($complaint->priority == 'medium')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-50 text-yellow-600 border border-yellow-200">
                                Medium
                            </span>

                        @else
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-50 text-green-600 border border-green-200">
                                Low
                            </span>
                        @endif

                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">

                        @if($complaint->status == 'pending')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-50 text-yellow-600 border border-yellow-200">
                                Pending
                            </span>

                        @elseif($complaint->status == 'proses')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-50 text-blue-600 border border-blue-200">
                                Proses
                            </span>

                        @else
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-50 text-green-600 border border-green-200">
                                Selesai
                            </span>
                        @endif

                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-4">

                        <div class="flex items-center justify-center gap-2">

                            <!-- DETAIL -->
                            <button type="button"
                                onclick="showDetail(
                                    '{{ $complaint->user->name }}',
                                    '{{ $complaint->judul }}',
                                    '{{ $complaint->priority }}',
                                    '{{ $complaint->status }}'
                                )"
                                class="px-3 py-1 text-xs bg-[#1e3a5f] text-white rounded hover:bg-[#16324a]">
                                Detail
                            </button>

                            <!-- UPDATE -->
                            <form action="{{ route('admin.complaints.updateStatus', $complaint->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <select name="status"
                                    class="border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none">

                                    <option value="pending">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>

                                </select>

                                <button class="ml-1 bg-[#38a38e] hover:bg-teal-700 text-white px-2 py-1 rounded text-xs font-bold">
                                    Save
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-400">
                        Belum ada komplain
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>
    </div>
</div>

<!-- MODAL -->
<div id="modal"
     class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white w-[420px] rounded-xl shadow-lg p-6">

        <h2 class="text-lg font-bold text-[#1e3a5f] mb-4">
            Detail Komplain
        </h2>

        <div class="space-y-2 text-sm">

            <p><b>User:</b> <span id="m-user"></span></p>
            <p><b>Judul:</b> <span id="m-judul"></span></p>
            <p><b>Priority:</b> <span id="m-priority"></span></p>
            <p><b>Status:</b> <span id="m-status"></span></p>

        </div>

        <button onclick="closeModal()"
                class="mt-5 w-full bg-[#38a38e] hover:bg-teal-700 text-white py-2 rounded-lg">
            Tutup
        </button>

    </div>
</div>
<script>
<script>
function showDetail(user, judul, priority, status) {
    document.getElementById('m-user').innerText = user;
    document.getElementById('m-judul').innerText = judul;
    document.getElementById('m-priority').innerText = priority;
    document.getElementById('m-status').innerText = status;

    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
</script>

</body>
</html>