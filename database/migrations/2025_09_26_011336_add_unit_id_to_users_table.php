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
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom unit_id yang merujuk ke tabel units
            $table->unsignedBigInteger('unit_id')->nullable()->after('id');

            // Foreign key ke tabel units
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key dulu baru hapus kolomnya
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
};
