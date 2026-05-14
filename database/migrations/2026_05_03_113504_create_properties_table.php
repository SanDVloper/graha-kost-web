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
       Schema::create('properties', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke tabel users (Hanya user dengan role 'tuan_kos' yang akan mengisi ini)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->string('name');
        $table->string('type'); 
        $table->year('year_established')->nullable();
        $table->text('description')->nullable();
        $table->json('facilities')->nullable(); 
        
        $table->string('electricity_rule')->default('token'); 
        $table->string('water_rule')->default('include'); 
        $table->integer('water_price')->nullable(); 
        $table->integer('deposit')->default(0);
        
        $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
