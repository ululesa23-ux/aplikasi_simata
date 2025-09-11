<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender_akademik', function (Blueprint $table) { // pakai jamak biar konsisten dgn Eloquent
            $table->id();
            $table->string('judul');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('jenis', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade'); // ✅ tambahin relasi unit
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_akademik');
    }
};
