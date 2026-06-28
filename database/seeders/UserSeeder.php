<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Tuan Kos Dummy',
                'email' => 'tuan@graha.com',
                'password' => '$2y$12$AHiRRejQG/PHmK/ikQwpWO2FFxsxlgrLiRL6FijcnswhSsBj4qAkO', // Password sudah di-hash sesuai database
                'role' => 'tuan_kos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'admin@graha.com',
                'password' => '$2y$12$.CWjws1.xaoHBlGr705cue5sdrmqf4vNaZOgmAIyjpwEqjOTU3gZS', //
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Customer',
                'email' => 'customer@graha.com',
                'password' => '$2y$12$X/nhowG1qYNMXTAAT/9Dy.s0KJk20z/VV.9d7uRzxP8KHnFg4uMdS', //
                'role' => 'pencari',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Memasukkan data ke dalam tabel users
        User::insert($users);
    }
}