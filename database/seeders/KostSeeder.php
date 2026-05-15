<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kost;

class KostSeeder extends Seeder
{
    public function run(): void
    {
        // Cara 1: manual insert
       DB::table('kosts')->insert([
    [
        'nama_kost' => 'Kost Graha Asri',
        'alamat' => 'Denpasar Barat',
        'image' => 'kost1.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'nama_kost' => 'Kost Melati Indah',
        'alamat' => 'Kuta',
        'image' => 'kost2.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
        // Cara 2: factory (kalau model & factory sudah ada)
        // Kost::factory()->count(20)->create();
    }
}