<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$p = App\Models\Property::latest()->first();
echo "URL: " . asset('storage/' . $p->photos[0]) . "\n";
echo "STRING: " . $p->photos[0] . "\n";
