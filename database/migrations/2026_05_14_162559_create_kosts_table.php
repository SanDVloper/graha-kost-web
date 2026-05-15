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
    Schema::create('kosts', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kost');
        $table->text('alamat')->nullable();
        $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('cascade');
        $table->integer('jumlah_kamar')->nullable();
        $table->string('denah')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};
