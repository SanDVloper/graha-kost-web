<?php
$files = glob('resources/views/admin/*.blade.php');
$files[] = 'resources/views/admin/complaints/index.blade.php';

$menus = [
    'Dashboard' => ['route' => "route('admin.dashboard')", 'permission' => 'dashboard'],
    'Enrollment' => ['route' => "route('admin.enrollment')", 'permission' => 'enrollment'],
    'Pengguna' => ['route' => "route('admin.users')", 'permission' => 'users'],
    'Kost' => ['route' => "route('admin.detail')", 'permission' => 'detail'],
    'Transaksi' => ['route' => "route('admin.tagihan')", 'permission' => 'tagihan'],
    'Komplain' => ['route' => "route('admin.complaints.index')", 'permission' => 'complaints'],
    'Laporan' => ['route' => "route('admin.laporan')", 'permission' => 'laporan'],
    'Pengaturan' => ['route' => "route('settings.global')", 'permission' => 'pengaturan']
];

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $content = file_get_contents($f);

    foreach ($menus as $text => $data) {
        $route = $data['route'];
        $permission = $data['permission'];

        // Pattern 1: Find the <a> tag that contains the $text in a span.
        // We will replace its href with the correct route if it's not already correct.
        $pattern = '/(<a\s+[^>]*href=")([^"]+)("[^>]*>.*?<span[^>]*>\s*' . preg_quote($text, '/') . '\s*<\/span>.*?<\/a>)/is';
        
        $content = preg_replace_callback($pattern, function($matches) use ($route) {
            $prefix = $matches[1];
            $currentHref = $matches[2];
            $suffix = $matches[3];
            
            // Just force the correct href
            $newHref = '{{ ' . $route . ' }}';
            return $prefix . $newHref . $suffix;
        }, $content);
        
        // Pattern 2: Wrap with @if(auth()->user()->hasPermission(...))
        // Now that the href is definitely {{ route(...) }}, we can match it and wrap it.
        $pattern2 = '/(<a\s+[^>]*href="\{\{\s*' . preg_quote($route, '/') . '\s*\}\}"[^>]*>.*?<\/a>)/is';
        $content = preg_replace_callback($pattern2, function($matches) use ($permission) {
            $html = $matches[1];
            return "@if(auth()->user()->hasPermission('$permission'))\n            " . $html . "\n            @endif";
        }, $content);
    }
    
    file_put_contents($f, $content);
    echo "Fixed $f\n";
}
