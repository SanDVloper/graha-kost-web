<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        // 2. Bersihkan tabel
        DB::table('users')->truncate();
        DB::table('properties')->truncate();
        DB::table('rooms')->truncate();
        DB::table('billings')->truncate();
        DB::table('complaints')->truncate();

        // 3. Hidupkan kembali pengecekan
        Schema::enableForeignKeyConstraints();

        // 4. BUAT DATA USER DARI USER SEEDER
        $this->call([
            UserSeeder::class,
        ]);

        // 5. MASUKKAN DATA KOS ASLI BALI
        $defaultFacilities = json_encode(['Wi-Fi', 'Parkir Motor', 'Dapur Bersama']);
        $defaultRules = json_encode(['Dilarang Membawa Narkoba', 'Dilarang Bawa Lawan Jenis', 'Jaga Kebersihan']);

        $properties = [
            ['user_id' => 1, 'name' => 'Kos Graha Muslimah (Renon, Denpasar)', 'type' => 'putri', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Tukad Barito No. 10, Renon, Denpasar. Kamar mandi dalam, kasur, lemari, dekat kawasan kampus.', 'facilities' => json_encode(['Dapur Bersama', 'Parkir Motor', 'CCTV']), 'rules' => json_encode(['Dilarang Bawa Lawan Jenis', 'Jam Malam 22:00']), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Dewata (Panjer, Denpasar)', 'type' => 'putra', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Tukad Pakerisan No. 85, Panjer, Denpasar. Fasilitas lengkap dengan Wi-Fi kencang, cocok untuk mahasiswa.', 'facilities' => json_encode(['Wi-Fi', 'Dapur', 'Parkir Luas']), 'rules' => json_encode(['Dilarang Bawa Hewan', 'Tamu Lapor 1x24 Jam']), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Sanur Residence (Sanur, Denpasar)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Danau Buyan No. 14, Sanur, Denpasar. Dekat Bypass Ngurah Rai dan Pantai Sanur. AC, parkir mobil aman.', 'facilities' => json_encode(['Kolam Renang', 'Parkir Mobil', 'Keamanan 24 Jam']), 'rules' => json_encode(['Dilarang Pesta', 'Akses 24 Jam']), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Melati (Kesiman, Denpasar)', 'type' => 'putri', 'year_established' => 2020, 'description' => 'Lokasi: Jl. Katrangan No. 45, Kesiman, Denpasar Timur. Lingkungan asri, include air, dekat kampus Warmadewa.', 'facilities' => json_encode(['Laundry', 'Ruang Santai', 'Dapur Mini']), 'rules' => json_encode(['Dilarang Merokok di Kamar', 'Tamu Maks 21:00']), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Kost Putra Mandiri (Jimbaran, Kuta Selatan)', 'type' => 'putra', 'year_established' => 2020, 'description' => 'Lokasi: Jl. Kampus Unud, Jimbaran, Kuta Selatan. Free Wi-Fi, AC, parkir luas, dekat gerbang utama UNUD.', 'facilities' => json_encode(['Parkir Luas', 'Dekat Kampus']), 'rules' => $defaultRules, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Premium Residence (Seminyak, Badung)', 'type' => 'campur', 'year_established' => 2024, 'description' => 'Lokasi: Jl. Sunset Road No. 88, Seminyak, Badung. Fasilitas eksklusif: AC, Water Heater, TV LED, kasur king-size.', 'facilities' => json_encode(['Kolam Renang', 'Gym', 'Layanan Kebersihan']), 'rules' => json_encode(['Dilarang Bawa Hewan', 'Deposit 1 Bulan']), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Backpacker Room (Kuta, Badung)', 'type' => 'campur', 'year_established' => 2018, 'description' => 'Lokasi: Jl. Raya Kuta Gg. Kubu, Kuta, Badung. Strategis di pusat pariwisata, dekat Bandara Ngurah Rai.', 'facilities' => $defaultFacilities, 'rules' => $defaultRules, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Canggu Pavilion (Canggu, Badung)', 'type' => 'campur', 'year_established' => 2025, 'description' => 'Lokasi: Jl. Batu Bolong No. 102, Canggu, Badung. Konsep studio room premium dengan dapur pribadi, kulkas, AC.', 'facilities' => json_encode(['Taman', 'Rooftop', 'Security']), 'rules' => $defaultRules, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha anyar (Dalung, Badung)', 'type' => 'putri', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Raya Dalung No. 12, Kuta Utara, Badung. Include kasur, lemari, listrik meteran mandiri.', 'facilities' => $defaultFacilities, 'rules' => $defaultRules, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Wijaya Luxury (Ubud, Gianyar)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Raya Pengosekan, Ubud, Gianyar. Bernuansa asri tradisional Bali, Wi-Fi kencang, AC.', 'facilities' => $defaultFacilities, 'rules' => $defaultRules, 'created_at' => now(), 'updated_at' => now()],
        ];

        // Tambahkan dummy sisanya sampai 30
        for ($i = 11; $i <= 30; $i++) {
            $properties[] = [
                'user_id' => 1, 
                'name' => "Kos Graha Cabang $i (Area Bali)", 
                'type' => (['putra', 'putri', 'campur'])[array_rand(['putra', 'putri', 'campur'])], 
                'year_established' => rand(2018, 2025), 
                'description' => 'Deskripsi dummy kos ke-' . $i . '. Lingkungan aman dan nyaman.', 
                'facilities' => $defaultFacilities, 
                'rules' => $defaultRules,
                'created_at' => now(), 
                'updated_at' => now()
            ];
        }

        DB::table('properties')->insert($properties);
        
        // 6. Buat beberapa Tipe Kamar secara acak untuk setiap kos
        $rooms = [];
        for ($i = 1; $i <= 30; $i++) {
            // Tipe Standar
            $rooms[] = [
                'property_id' => $i,
                'name' => 'Kamar Standar Non-AC',
                'size' => '3x3',
                'quantity' => rand(2, 5),
                'price_monthly' => 600000,
                'price_daily' => 50000,
                'price_yearly' => 6500000,
                'facilities' => json_encode(['Kasur', 'Lemari', 'Kipas Angin', 'Kamar Mandi Luar']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Tipe VIP
            $rooms[] = [
                'property_id' => $i,
                'name' => 'Kamar VIP AC & Kamar Mandi Dalam',
                'size' => '4x4',
                'quantity' => rand(1, 3),
                'price_monthly' => 1200000,
                'price_daily' => 100000,
                'price_yearly' => 13000000,
                'facilities' => json_encode(['Kasur Springbed', 'Lemari', 'AC', 'Kamar Mandi Dalam', 'Meja Belajar']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Khusus property tertentu (tiap kelipatan 3) ada tipe Suite
            if ($i % 3 === 0) {
                $rooms[] = [
                    'property_id' => $i,
                    'name' => 'Executive Suite Room',
                    'size' => '5x5',
                    'quantity' => rand(0, 2),
                    'price_monthly' => 2500000,
                    'price_daily' => 200000,
                    'price_yearly' => 28000000,
                    'facilities' => json_encode(['King Bed', 'AC', 'Water Heater', 'TV LED', 'Kulkas Mini', 'Sofa']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('rooms')->insert($rooms);

        // 7. Tambahkan dummy data Billings untuk Admin/Landlord (Misal yang pesan user_id=3)
        $billings = [
            // property_id = 1, room_id = 1 (Kamar Standar) & 2 (Kamar VIP)
            ['user_id' => 3, 'property_id' => 1, 'room_id' => 2, 'duration' => 'bulanan', 'amount' => 1200000, 'status' => 'pending_approval', 'due_date' => now()->addDays(3), 'created_at' => now()->subHours(2), 'updated_at' => now()->subHours(2)],
            // property_id = 2, room_id = 4 (Kamar VIP properti ke-2)
            ['user_id' => 3, 'property_id' => 2, 'room_id' => 4, 'duration' => 'harian', 'amount' => 100000, 'status' => 'unpaid', 'due_date' => now()->addDays(1), 'created_at' => now()->subHours(5), 'updated_at' => now()->subHours(5)],
            // property_id = 3, room_id = 7 (Executive Suite properti ke-3)
            ['user_id' => 3, 'property_id' => 3, 'room_id' => 7, 'duration' => 'tahunan', 'amount' => 28000000, 'status' => 'paid', 'due_date' => now()->subDays(5), 'created_at' => now()->subDays(10), 'updated_at' => now()->subDays(5)],
        ];
        DB::table('billings')->insert($billings);

        // 8. Tambahkan dummy data Complaints untuk Admin
        $complaints = [
            ['user_id' => 3, 'judul' => 'Cara bayar kos?', 'isi_komplain' => 'Apakah bisa lewat transfer bank BCA?', 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'judul' => 'Web lambat', 'isi_komplain' => 'Saat memuat gambar terasa agak lama', 'status' => 'proses', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'judul' => 'Salah kamar', 'isi_komplain' => 'Tadi saya kepencet pilih kamar standar, padahal mau VIP. Tolong cancelkan', 'status' => 'selesai', 'created_at' => now()->subDays(2), 'updated_at' => now()->subDays(2)],
        ];
        DB::table('complaints')->insert($complaints);
    }
}
