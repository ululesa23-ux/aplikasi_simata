<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_ijins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                  // nama karyawan/siswa
            $table->string('unit');                  // unit/sekolah/divisi
            $table->unsignedTinyInteger('bulan');    // bulan laporan (1-12)
            $table->unsignedSmallInteger('tahun');   // tahun laporan
            $table->integer('total_ijin')->default(0); // total jumlah ijin
            $table->timestamps();

            // optional: biar ga ada data dobel dalam periode yg sama
            $table->unique(['nama', 'unit', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_ijins');
    }
};
