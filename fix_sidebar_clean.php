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
    
    // We only want to process the <nav> section
    $navStart = strpos($content, '<nav');
    $navEnd = strpos($content, '</nav>');
    
    if ($navStart === false || $navEnd === false) continue;
    
    $beforeNav = substr($content, 0, $navStart);
    $navContent = substr($content, $navStart, $navEnd - $navStart + 6);
    $afterNav = substr($content, $navEnd + 6);
    
    foreach ($menus as $text => $data) {
        $route = $data['route'];
        $permission = $data['permission'];

        // Pattern 1: Find <a> tag for the menu, capture href content
        $pattern = '/(<a\s+[^>]*href=")([^"]+)("[^>]*>.*?<span[^>]*>\s*' . preg_quote($text, '/') . '\s*<\/span>.*?<\/a>)/is';
        
        $navContent = preg_replace_callback($pattern, function($matches) use ($route) {
            $prefix = $matches[1];
            $currentHref = $matches[2];
            $suffix = $matches[3];
            
            // Set the href to the route
            $newHref = '{{ ' . $route . ' }}';
            return $prefix . $newHref . $suffix;
        }, $navContent);
        
        // Pattern 2: Wrap with @if
        $pattern2 = '/(<a\s+[^>]*href="\{\{\s*' . preg_quote($route, '/') . '\s*\}\}"[^>]*>.*?<\/a>)/is';
        $navContent = preg_replace_callback($pattern2, function($matches) use ($permission) {
            $html = $matches[1];
            
            // If it's already wrapped (from git maybe), we don't want to wrap it again.
            // Since we extracted only navContent and applied it, we can check if it's already in an @if
            return "@if(auth()->user()->hasPermission('$permission'))\n            " . $html . "\n            @endif";
        }, $navContent);
    }
    
    // Clean up any double @if that might have occurred if the file already had @if
    $navContent = preg_replace('/@if\s*\([^)]+\)\s*@if\s*\([^)]+\)/s', '@if(auth()->user()->hasPermission(\'$1\'))', $navContent); // This regex is bad, let's just do a simpler cleanup
    $navContent = preg_replace('/@if\(auth\(\)->user\(\)->hasPermission\(\'[^\']+\'\)\)\s*@if\(auth\(\)->user\(\)->hasPermission\(\'([^\']+)\'\)\)/s', '@if(auth()->user()->hasPermission(\'$1\'))', $navContent);
    $navContent = preg_replace('/@endif\s*@endif/s', '@endif', $navContent);
    
    $content = $beforeNav . $navContent . $afterNav;
    file_put_contents($f, $content);
    echo "Fixed $f\n";
}
