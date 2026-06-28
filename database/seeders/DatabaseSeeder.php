<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key agar bisa dibersihkan
        Schema::disableForeignKeyConstraints();

        // 2. Bersihkan tabel-tabel utama (Otomatis reset ID kembali ke 1)
        DB::table('users')->truncate();
        DB::table('properties')->truncate();
        DB::table('rooms')->truncate();

        // 3. Hidupkan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        // 4. BUAT DATA USER DARI USER SEEDER
        // (Tuan Kos akan otomatis mendapat ID 1, Admin ID 2, dan Customer ID 3)
        $this->call([
            UserSeeder::class,
        ]);

        // 5. MASUKKAN 30 DATA KOS ASLI BALI 
        // (Karena user_id = 1, semua kos ini otomatis menjadi milik "Tuan Kos Dummy")
        DB::table('properties')->insert([
            // --- DENPASAR ---
            ['user_id' => 1, 'name' => 'Kos Graha Muslimah (Renon, Denpasar)', 'type' => 'putri', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Tukad Barito No. 10, Renon, Denpasar. Kamar mandi dalam, kasur, lemari, dekat kawasan kampus.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Dewata (Panjer, Denpasar)', 'type' => 'putra', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Tukad Pakerisan No. 85, Panjer, Denpasar. Fasilitas lengkap dengan Wi-Fi kencang, cocok untuk mahasiswa.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Sanur Residence (Sanur, Denpasar)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Danau Buyan No. 14, Sanur, Denpasar. Dekat Bypass Ngurah Rai dan Pantai Sanur. AC, parkir mobil aman.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Melati (Kesiman, Denpasar)', 'type' => 'putri', 'year_established' => 2020, 'description' => 'Lokasi: Jl. Katrangan No. 45, Kesiman, Denpasar Timur. Lingkungan asri, include air, dekat kampus Warmadewa.', 'created_at' => now(), 'updated_at' => now()],
            // --- BADUNG ---
            ['user_id' => 1, 'name' => 'Graha Kost Putra Mandiri (Jimbaran, Kuta Selatan)', 'type' => 'putra', 'year_established' => 2020, 'description' => 'Lokasi: Jl. Kampus Unud, Jimbaran, Kuta Selatan. Free Wi-Fi, AC, parkir luas, dekat gerbang utama UNUD.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Premium Residence (Seminyak, Badung)', 'type' => 'campur', 'year_established' => 2024, 'description' => 'Lokasi: Jl. Sunset Road No. 88, Seminyak, Badung. Fasilitas eksklusif: AC, Water Heater, TV LED, kasur king-size.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Backpacker Room (Kuta, Badung)', 'type' => 'campur', 'year_established' => 2018, 'description' => 'Lokasi: Jl. Raya Kuta Gg. Kubu, Kuta, Badung. Strategis di pusat pariwisata, dekat Bandara Ngurah Rai.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Canggu Pavilion (Canggu, Badung)', 'type' => 'campur', 'year_established' => 2025, 'description' => 'Lokasi: Jl. Batu Bolong No. 102, Canggu, Badung. Konsep studio room premium dengan dapur pribadi, kulkas, AC.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha anyar (Dalung, Badung)', 'type' => 'putri', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Raya Dalung No. 12, Kuta Utara, Badung. Include kasur, lemari, listrik meteran mandiri.', 'created_at' => now(), 'updated_at' => now()],
            // --- GIANYAR ---
            ['user_id' => 1, 'name' => 'Kos Graha Wijaya Luxury (Ubud, Gianyar)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Raya Pengosekan, Ubud, Gianyar. Bernuansa asri tradisional Bali, Wi-Fi kencang, AC.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Asri (Kec. Gianyar, Gianyar)', 'type' => 'putri', 'year_established' => 2019, 'description' => 'Lokasi: Jl. Abianbase No. 15, Kec. Gianyar, Gianyar. Kamar minimalis ekonomis, aman dengan gerbang gembok.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Tirta (Melinggih, Payangan)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Raya Payangan, Melinggih, Gianyar. Udara sejuk perbukitan, cocok untuk pekerja perhotelan.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Lotus (Sukawati, Gianyar)', 'type' => 'putri', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Raya Batubulan, Sukawati, Gianyar. Dekat Pasar Seni Sukawati, fasilitas kamar mandi dalam.', 'created_at' => now(), 'updated_at' => now()],
            // --- BULELENG ---
            ['user_id' => 1, 'name' => 'Kos Graha Safira (Singaraja, Buleleng)', 'type' => 'putri', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Udayana Gg. 2B, Kaliuntu, Buleleng. Jarak sangat dekat ke area kampus Undiksha.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Cendana (Kampung Kajanan, Singaraja)', 'type' => 'putra', 'year_established' => 2024, 'description' => 'Lokasi: Jl. Erlangga, Kampung Kajanan, Singaraja. Kamar mandi dalam, kasur busa tebal, dekat pelabuhan tua.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Banyuasri Residence (Banyuasri, Singaraja)', 'type' => 'campur', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Ahmad Yani No. 140, Banyuasri, Singaraja. Fasilitas AC, Wi-Fi gratis, parkir beratap.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Penarukan (Penarukan, Buleleng)', 'type' => 'putra', 'year_established' => 2020, 'description' => 'Lokasi: Jl. Pantai Penarukan, Buleleng. Kamar kosongan ekonomis, ukuran luas 4x4 meter.', 'created_at' => now(), 'updated_at' => now()],
            // --- TABANAN ---
            ['user_id' => 1, 'name' => 'Kos Graha Lavender (Delod Peken, Tabanan)', 'type' => 'putri', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Gajah Mada No. 42, Delod Peken, Tabanan. Kasur, lemari pakaian, token listrik mandiri.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Kenanga (Dajan Peken, Tabanan)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Ngurah Rai No. 18, Dajan Peken, Tabanan. Tepat di pusat kota Tabanan, dekat RSUD.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Graha Kediri Kost (Kediri, Tabanan)', 'type' => 'putra', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Raya Kediri - Tanah Lot, Kediri, Tabanan. Akses jalan lebar, dekat kawasan bisnis.', 'created_at' => now(), 'updated_at' => now()],
            // --- JEMBRANA ---
            ['user_id' => 1, 'name' => 'Kos Graha Perkasa (Banjar Tengah, Jembrana)', 'type' => 'putra', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Ngurah Rai No. 102, Banjar Tengah, Jembrana. Khusus pria, aman dipantau CCTV 24 jam.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Bahari (Negara, Jembrana)', 'type' => 'campur', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Putu Diah, Negara, Jembrana. Bangunan baru bersih, sewa bulanan terjangkau.', 'created_at' => now(), 'updated_at' => now()],
            // --- KLUNGKUNG ---
            ['user_id' => 1, 'name' => 'Graha Premium Suites (Semarapura, Klungkung)', 'type' => 'campur', 'year_established' => 2025, 'description' => 'Lokasi: Jl. Puputan No. 5, Semarapura Klod. Desain modern minimalis, AC, kasur springbed.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Kertagosa (Semarapura Tengah, Klungkung)', 'type' => 'putri', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Untung Surapati, Klungkung. Dekat objek wisata Kertagosa, khusus wanita.', 'created_at' => now(), 'updated_at' => now()],
            // --- BANGLI ---
            ['user_id' => 1, 'name' => 'Graha Kost Bukit Kintamani (Kintamani, Bangli)', 'type' => 'campur', 'year_established' => 2024, 'description' => 'Lokasi: Jl. Raya Penelokan, Kintamani, Bangli. Kamar eksklusif dengan Water Heater, view Gunung Batur.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Cempaka (Kawan, Bangli)', 'type' => 'putri', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Nusantara, Kelurahan Kawan, Bangli. Dekat pusat perkantoran daerah Bangli.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Tirta Indah (Kubutambahan, Bangli)', 'type' => 'putra', 'year_established' => 2020, 'description' => 'Lokasi: Jl. Brigjen Ngurah Rai, Bangli. Kamar mandi dalam, parkir motor luas berpagar.', 'created_at' => now(), 'updated_at' => now()],
            // --- KARANGASEM ---
            ['user_id' => 1, 'name' => 'Graha Kost Gajah Mada (Subagan, Karangasem)', 'type' => 'campur', 'year_established' => 2023, 'description' => 'Lokasi: Jl. Gajah Mada, Subagan, Karangasem. Dekat pusat pertokoan, fasilitas AC, lemari.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Jempiring (Padangbai, Karangasem)', 'type' => 'putra', 'year_established' => 2022, 'description' => 'Lokasi: Jl. Silayukti, Padangbai. Sangat dekat dengan area pelabuhan penyeberangan.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'name' => 'Kos Graha Nirwana (Amlapura, Karangasem)', 'type' => 'putri', 'year_established' => 2021, 'description' => 'Lokasi: Jl. Bhayangkara, Amlapura, Karangasem. Khusus wanita, dekat dengan pusat kuliner kota.', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        // 6. OPSIONAL NAMUN SANGAT DISARANKAN: Buatkan 1 kamar dummy untuk setiap kos 
        // agar saat diklik "Lihat Detail", harganya tidak Rp 0
        $rooms = [];
        for ($i = 1; $i <= 30; $i++) {
            $rooms[] = [
                'property_id' => $i,
                'name' => 'Kamar Standar',
                'size' => '3x4',
                'quantity' => rand(3, 10),
                'price_monthly' => rand(5, 15) * 100000, // Harga acak antara 500rb - 1.5jt
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('rooms')->insert($rooms);
    }
}