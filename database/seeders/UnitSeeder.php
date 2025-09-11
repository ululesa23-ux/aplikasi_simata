<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['nama_unit' => 'Daycare'],
            ['nama_unit' => 'Preschool'],
            ['nama_unit' => 'PG'],
            ['nama_unit' => 'TK'],
            ['nama_unit' => 'TK Islam Platinum'],
            ['nama_unit' => 'SDIT'],
            ['nama_unit' => 'MIIT'],
            ['nama_unit' => 'SMP'],
            ['nama_unit' => 'MA Yayasan Permata Mojokerto'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
