<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'imei',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed', // otomatis hash saat create/update
    ];

    // Simpan user baru ke database
    public static function createUser($request)
    {
        return self::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'imei'     => $request->imei,
            'role'     => 'user',
        ]);
    }
}
