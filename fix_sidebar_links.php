<?php
$files = glob('resources/views/admin/*.blade.php');
$files[] = 'resources/views/admin/complaints/index.blade.php';

// First, we find all instances where an anchor tag contains an icon and a text that matches our menu, and replace its href and wrap with @if.
// A better way is to identify the menu by the text inside the span.

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

        // Pattern to find the anchor block containing the span with the menu text
        // It looks for <a ...> ... <span ...>Text</span> ... </a>
        // Note: we only want to fix links that have href="#" or href="" if they should be pointing to a route.
        // Let's do a more generic replacement.
        // Let's find <a ... href="#" ... > ... $text ... </a>
        $pattern = '/<a\s+[^>]*href="([^"]+)"[^>]*>.*?<span[^>]*>\s*' . preg_quote($text, '/') . '\s*<\/span>.*?<\/a>/is';
        
        $content = preg_replace_callback($pattern, function($matches) use ($route, $permission) {
            $html = $matches[0];
            $currentHref = $matches[1];
            
            // If it's already the correct route, just check for permission wrap
            // If it's '#', replace '#' with {{ $route }}
            if (strpos($currentHref, '#') !== false) {
                $html = str_replace('href="#"', 'href="{{ ' . $route . ' }}"', $html);
            }
            
            return $html;
        }, $content);
        
        // Ensure @if permission is wrapped around it
        $pattern2 = '/<a href="\{\{\s*' . preg_quote($route, '/') . '\s*\}\}"[^>]*>.*?<\/a>/is';
        $content = preg_replace_callback($pattern2, function($matches) use ($permission) {
            $html = $matches[0];
            // If already wrapped with this permission, skip to avoid double wrap
            if (strpos($html, "hasPermission('$permission')") !== false) {
                return $html;
            }
            return "@if(auth()->user()->hasPermission('$permission'))\n            " . $html . "\n            @endif";
        }, $content);
    }
    
    // There is a case where the active link doesn't use the route, e.g. `<a href="#" class="... bg-teal-50 ...">`
    // Wait, the active link shouldn't be wrapped in another @if if it is already inside one, but let's just make sure href is correct.
    
    file_put_contents($f, $content);
    echo "Fixed links in $f\n";
}
