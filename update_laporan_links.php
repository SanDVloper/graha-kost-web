<?php
$files = glob('resources/views/admin/*.blade.php');
$files[] = 'resources/views/admin/complaints/index.blade.php';

foreach($files as $f) {
    if (!file_exists($f)) continue;
    
    $c = file_get_contents($f);
    
    // Replace dummy Laporan link with real route
    $c = preg_replace(
        '/<a href="javascript:void\(0\)" onclick="alert\(\'Fitur Laporan sedang dalam pengembangan\'\)"\s+class="flex items-center px-4 py-2\.5 text-gray-500 hover:bg-gray-50 hover:text-\[#38a38e\] rounded-lg transition-colors">/', 
        '<a href="{{ route(\'admin.laporan\') }}" class="flex items-center px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-[#38a38e] rounded-lg transition-colors">', 
        $c
    );
    
    file_put_contents($f, $c);
    echo "Updated $f\n";
}
