<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'unit',
        'tanggal',
        'keterangan',
    ];

    // Relasi ke laporan ijin
    public function laporanIjin()
    {
        return $this->hasOne(LaporanIjin::class, 'nama', 'nama');
    }
}
