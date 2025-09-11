<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends \Illuminate\Database\Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'imei' => null, // Admin bisa login dari mana saja
        ]);
    }
}
