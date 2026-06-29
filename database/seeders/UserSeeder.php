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
                'is_super_admin' => false,
                'permissions' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'admin@graha.com',
                'password' => '$2y$12$.CWjws1.xaoHBlGr705cue5sdrmqf4vNaZOgmAIyjpwEqjOTU3gZS', //
                'role' => 'admin',
                'is_super_admin' => true,
                'permissions' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Laporan',
                'email' => 'admin_laporan@graha.com',
                'password' => '$2y$12$.CWjws1.xaoHBlGr705cue5sdrmqf4vNaZOgmAIyjpwEqjOTU3gZS', // Sama dengan password admin@graha.com (password: password)
                'role' => 'admin',
                'is_super_admin' => false,
                'permissions' => json_encode(['laporan']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Customer',
                'email' => 'customer@graha.com',
                'password' => '$2y$12$X/nhowG1qYNMXTAAT/9Dy.s0KJk20z/VV.9d7uRzxP8KHnFg4uMdS', //
                'role' => 'pencari',
                'is_super_admin' => false,
                'permissions' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Memasukkan data ke dalam tabel users
        User::insert($users);
    }
}