<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanIjin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'unit',
        'bulan',
        'tahun',
        'total_ijin',
    ];

    // Relasi ke ijin
    public function ijins()
    {
        return $this->hasMany(Ijin::class, 'nama', 'nama');
    }
}
