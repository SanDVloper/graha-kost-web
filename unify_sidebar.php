<?php
$files = glob('resources/views/admin/*.blade.php');
$files[] = 'resources/views/admin/complaints/index.blade.php';

$newNav = <<<'EOF'
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            @if(auth()->user()->hasPermission('dashboard'))
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg mb-2 transition-colors {{ Request::routeIs('admin.dashboard') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-chart-pie"></i></div>
                <span class="font-medium ml-3">Dashboard</span>
            </a>
            @endif
            
            @if(auth()->user()->hasPermission('enrollment'))
            <a href="{{ route('admin.enrollment') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.enrollment') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-user-check"></i></div>
                <span class="font-bold ml-3">Enrollment</span>
            </a>
            @endif

            @if(auth()->user()->hasPermission('users'))
            <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.users') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-users"></i></div>
                <span class="font-medium ml-3">Pengguna</span>
            </a>
            @endif
           
            @if(auth()->user()->hasPermission('detail'))
            <a href="{{ route('admin.detail') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.detail') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-building"></i></div>
                <span class="font-medium ml-3">Kost</span>
            </a>
            @endif

            @if(auth()->user()->hasPermission('tagihan'))
            <a href="{{ route('admin.tagihan') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.tagihan') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="font-medium ml-3">Transaksi</span>
            </a>
            @endif

            @if(auth()->user()->hasPermission('complaints'))
            <a href="{{ route('admin.complaints.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.complaints.index') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="flex items-center">
                    <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <span class="font-medium ml-3">Komplain</span>
                </div>
            </a>
            @endif

            @if(auth()->user()->hasPermission('laporan'))
            <a href="{{ route('admin.laporan') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('admin.laporan') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-file-lines"></i></div>
                <span class="font-medium ml-3">Laporan</span>
            </a>
            @endif

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-4">System</div>
            
            @if(auth()->user()->hasPermission('pengaturan'))
            <a href="{{ route('settings.global') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ Request::routeIs('settings.global') ? 'bg-teal-50 text-[#38a38e]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#38a38e]' }}">
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="font-medium ml-3">Pengaturan</span>
            </a>
            @endif
        </nav>
EOF;

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $content = file_get_contents($f);
    
    $navStart = strpos($content, '<nav');
    $navEnd = strpos($content, '</nav>');
    
    if ($navStart === false || $navEnd === false) continue;
    
    $beforeNav = substr($content, 0, $navStart);
    $afterNav = substr($content, $navEnd + 6);
    
    $content = $beforeNav . $newNav . $afterNav;
    file_put_contents($f, $content);
    echo "Replaced nav in $f\n";
}
