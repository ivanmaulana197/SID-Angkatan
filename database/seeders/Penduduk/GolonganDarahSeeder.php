<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\GolonganDarah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongan_darah = [
            'TIDAK TAHU','A', 'B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'
        ];

        foreach ($golongan_darah as $value ) {
            GolonganDarah::create([
                'nama'=>$value
            ]);
        }
    }
}
