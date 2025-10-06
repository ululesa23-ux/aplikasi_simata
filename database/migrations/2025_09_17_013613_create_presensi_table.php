<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_presensi'); // datang / pulang
            $table->string('nama');
            $table->string('unit');
            $table->date('tanggal');
            $table->time('waktu');
            $table->decimal('jarak', 8, 2)->nullable(); // dalam km atau meter
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
