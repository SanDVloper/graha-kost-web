<?php
$files = glob('resources/views/admin/*.blade.php');
$files[] = 'resources/views/admin/complaints/index.blade.php';

$menuMap = [
    'dashboard' => "route('admin.dashboard')",
    'enrollment' => "route('admin.enrollment')",
    'users' => "route('admin.users')",
    'detail' => "route('admin.detail')",
    'tagihan' => "route('admin.tagihan')",
    'complaints' => "route('admin.complaints.index')",
    'laporan' => "route('admin.laporan')",
    'pengaturan' => "route('settings.global')"
];

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $content = file_get_contents($f);

    foreach ($menuMap as $permission => $route) {
        // Regex to find the <a href="{{ $route }}" ...>...</a>
        // It spans multiple lines
        $pattern = '/<a href="\{\{\s*' . preg_quote($route, '/') . '\s*\}\}"[^>]*>.*?<\/a>/is';
        
        $content = preg_replace_callback($pattern, function($matches) use ($permission) {
            $html = $matches[0];
            // Don't wrap if it's already wrapped
            if (strpos($html, '@if(auth()->user()->hasPermission') !== false) {
                return $html;
            }
            return "@if(auth()->user()->hasPermission('$permission'))\n            " . $html . "\n            @endif";
        }, $content);
    }
    
    file_put_contents($f, $content);
    echo "Updated $f\n";
}
