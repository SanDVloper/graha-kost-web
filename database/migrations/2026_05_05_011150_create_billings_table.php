<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Relasi ke penyewa
            $table->foreignId('property_id')->nullable()->constrained('properties')->cascadeOnDelete(); // Relasi ke kos
            $table->integer('amount')->default(0); // Jumlah tagihan
            $table->string('status')->default('pending'); // pending, paid, overdue
            $table->date('due_date')->nullable(); // Tanggal jatuh tempo
            $table->timestamps();
        });
    }
};
