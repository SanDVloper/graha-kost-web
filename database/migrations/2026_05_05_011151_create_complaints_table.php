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
        Schema::create('complaints', function (Blueprint $table) {
<<<<<<< HEAD
    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->string('judul');
    $table->text('isi_komplain');

    $table->enum('status', ['pending', 'proses', 'selesai'])
          ->default('pending');

    $table->timestamps();
});
=======
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Relasi ke pembuat komplain
            $table->text('pesan'); // Isi komplain
            $table->string('status')->default('pending'); // pending, diproses, selesai
            $table->timestamps();
        });
>>>>>>> 49c3cf517adcd415cecc4e0f02dd1bb68627fd28
    }
};
