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
        if (!Schema::hasColumn('properties', 'photos')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->json('photos')->after('description')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('properties', 'photos')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('photos');
            });
        }
    }
};
