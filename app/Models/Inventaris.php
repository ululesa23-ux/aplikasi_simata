<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Inventaris extends Model
{
use HasFactory;


protected $fillable = [
'kode', 'nama', 'deskripsi', 'jumlah', 'kondisi', 'lokasi', 'tanggal_masuk', 'foto'
];


protected $casts = [
'tanggal_masuk' => 'date',
];
}