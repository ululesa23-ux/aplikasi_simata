<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                  // nama karyawan/siswa
            $table->string('unit');                  // unit/sekolah/divisi
            $table->unsignedTinyInteger('bulan');    // bulan laporan (1-12)
            $table->unsignedSmallInteger('tahun');   // tahun laporan
            $table->integer('total_hadir')->default(0);   // total presensi datang
            $table->integer('total_pulang')->default(0);  // total presensi pulang
            $table->timestamps();

            // optional: biar ga dobel data untuk orang yang sama dalam bulan+tahun
            $table->unique(['nama', 'unit', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_presensis');
    }
};
