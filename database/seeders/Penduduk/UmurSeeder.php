<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\PendudukUmur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UmurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [
            ['nama' => 'Di bawah 1 Tahun', 'dari' => 0, 'sampai' => 1],
            ['nama' => '2 s/d 4 Tahun', 'dari' => 2, 'sampai' => 4],
            ['nama' => '5 s/d 9 Tahun', 'dari' => 5, 'sampai' => 9],
            ['nama' => '10 s/d 14 Tahun', 'dari' => 10, 'sampai' => 14],
            ['nama' => '15 s/d 19 Tahun', 'dari' => 15, 'sampai' => 19],
            ['nama' => '20 s/d 24 Tahun', 'dari' => 20, 'sampai' => 24],
            ['nama' => '25 s/d 29 Tahun', 'dari' => 25, 'sampai' => 29],
            ['nama' => '30 s/d 34 Tahun', 'dari' => 30, 'sampai' => 34],
            ['nama' => '35 s/d 39 Tahun', 'dari' => 35, 'sampai' => 39],
            ['nama' => '40 s/d 44 Tahun', 'dari' => 40, 'sampai' => 44],
            ['nama' => '45 s/d 49 Tahun', 'dari' => 45, 'sampai' => 49],
            ['nama' => '50 s/d 54 Tahun', 'dari' => 50, 'sampai' => 54],
            ['nama' => '55 s/d 59 Tahun', 'dari' => 55, 'sampai' => 59],
            ['nama' => '60 s/d 64 Tahun', 'dari' => 60, 'sampai' => 64],
            ['nama' => '65 s/d 69 Tahun', 'dari' => 65, 'sampai' => 69],
            ['nama' => '70 s/d 74 Tahun', 'dari' => 70, 'sampai' => 74],
            ['nama' => 'Di atas 75 Tahun', 'dari' => 75, 'sampai' => 99999],
        ];

        foreach ($data as $value) {
            PendudukUmur::create([
                'nama'=>$value['nama'],
                'dari'=>$value['dari'],
                'sampai'=>$value['sampai'],
            ]);
        }
    }
}
