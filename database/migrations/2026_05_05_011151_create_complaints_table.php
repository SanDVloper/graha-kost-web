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
    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->string('judul');
    $table->text('isi_komplain');

    $table->enum('status', ['pending', 'proses', 'selesai'])
          ->default('pending');

    $table->timestamps();
});
    }
};
