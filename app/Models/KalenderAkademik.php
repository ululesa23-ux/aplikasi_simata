<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderAkademik extends Model
{
    use HasFactory;

    protected $table = 'kalender_akademik';

    protected $fillable = [
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis',
        'keterangan',
        'unit_id', // ✅ tambahkan biar bisa mass assignment
    ];

    // ✅ Relasi ke tabel units
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
