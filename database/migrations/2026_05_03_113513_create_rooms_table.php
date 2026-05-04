<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel properties (Jika properti dihapus, kamar ikut terhapus)
        $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
        
        $table->string('name'); // Misal: Standard Non-AC
        $table->string('size'); // Misal: 3 x 4
        $table->integer('quantity')->default(1);
        $table->json('facilities')->nullable(); // Fasilitas dalam kamar (Kasur, AC, dll)
        
        // Harga Sewa
        $table->integer('price_monthly')->nullable();
        $table->integer('price_daily')->nullable();
        $table->integer('price_yearly')->nullable();
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
