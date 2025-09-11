<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'nama_unit',
        'kode_unit',
        'deskripsi',
    ];

    // Relasi ke KalenderAkademik
    public function kalenderAkademik()
    {
        return $this->hasMany(KalenderAkademik::class, 'unit_id');
    }
}
