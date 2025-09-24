<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPresensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'unit',
        'bulan',
        'tahun',
        'total_hadir',
        'total_pulang',
    ];

    // Relasi ke presensi
    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'nama', 'nama');
    }
}
