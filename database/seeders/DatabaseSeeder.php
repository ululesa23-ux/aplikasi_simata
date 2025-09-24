<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'imei' => '000111222',
            ]
        );

        // TU
        User::updateOrCreate(
            ['username' => 'tu'],
            [
                'password' => Hash::make('tu123'),
                'role' => 'tu',
                'imei' => '111222333',
            ]
        );

        // Kabid
        User::updateOrCreate(
            ['username' => 'kabid'],
            [
                'password' => Hash::make('kabid123'),
                'role' => 'kabid',
                'imei' => '222333444',
            ]
        );
    }
}
