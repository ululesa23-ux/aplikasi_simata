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
        Schema::create('units', function (Blueprint $table) {
            $table->id(); // primary key, unsignedBigInteger otomatis
            $table->string('nama_unit'); // misal: SD, SMP, SMA
            $table->string('kode_unit')->nullable(); // kode unit opsional
            $table->text('deskripsi')->nullable(); // deskripsi unit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
