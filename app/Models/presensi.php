<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_presensi',
        'nama',
        'unit',
        'tanggal',
        'waktu',
        'jarak',
    ];

    // Relasi ke laporan presensi
    public function laporanPresensi()
    {
        return $this->hasOne(LaporanPresensi::class, 'nama', 'nama');
    }
}
