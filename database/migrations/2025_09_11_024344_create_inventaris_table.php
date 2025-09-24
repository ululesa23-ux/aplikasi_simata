<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('inventaris', function (Blueprint $table) {
$table->id();
$table->string('kode')->unique();
$table->string('nama');
$table->text('deskripsi')->nullable();
$table->integer('jumlah')->default(1);
$table->string('kondisi')->default('Baik');
$table->string('lokasi')->nullable();
$table->date('tanggal_masuk')->nullable();
$table->string('foto')->nullable();
$table->timestamps();
});
}


public function down(): void
{
Schema::dropIfExists('inventaris');
}
};