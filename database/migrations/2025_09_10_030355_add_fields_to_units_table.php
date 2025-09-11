<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('units', function (Blueprint $table) {
            if (!Schema::hasColumn('units', 'kode_unit')) {
                $table->string('kode_unit', 50)->nullable()->after('nama_unit');
            }
            if (!Schema::hasColumn('units', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('kode_unit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['kode_unit', 'deskripsi']);
        });
    }
};
