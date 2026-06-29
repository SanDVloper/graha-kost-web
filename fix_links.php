<?php
$files = glob('resources/views/admin/*.blade.php');
$files[] = 'resources/views/admin/complaints/index.blade.php';

foreach($files as $f) {
    if (!file_exists($f)) continue;
    
    $c = file_get_contents($f);
    
    // Replace Laporan link
    $c = preg_replace(
        '/<a href="#"([^>]+)>\s*<div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-file-lines"><\/i><\/div>\s*<span class="font-medium ml-3">Laporan<\/span>\s*<\/a>/s', 
        '<a href="javascript:void(0)" onclick="alert(\'Fitur Laporan sedang dalam pengembangan\')" $1>
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-file-lines"></i></div>
                <span class="font-medium ml-3">Laporan</span>
            </a>', 
        $c
    );
    
    // Replace Pengaturan link
    $c = preg_replace(
        '/<a href="#"([^>]+)>\s*<div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"><\/i><\/div>\s*<span class="font-medium ml-3">Pengaturan<\/span>\s*<\/a>/s', 
        '<a href="{{ route(\'settings.global\') }}" $1>
                <div class="w-6 shrink-0 flex justify-center"><i class="fa-solid fa-gear"></i></div>
                <span class="font-medium ml-3">Pengaturan</span>
            </a>', 
        $c
    );
    
    file_put_contents($f, $c);
    echo "Updated $f\n";
}
