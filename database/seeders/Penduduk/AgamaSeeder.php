<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agama = ['ISLAM', 'KRISTEN', 'KATHOLIK', 'HINDU', 'BUDHA', 'KONGHUCU', 'Kepercayaan Terhadap Tuhan YME / Lainnya'];
        
        foreach ($agama as $value) {
            # code...
            Agama::create([
                'nama' => $value,
            ]);
        }
    }
}
