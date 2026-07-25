<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\Penyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakit = ['JANTUNG', 'LEVER', 'PARU-PARU', 'KANKER', 'STROKE', 'DIABETES MELITUS', 'GINJAL', 'MALARIA', 'LEPRA/KUSTA', 'HIV/AIDS', 'GILA/STRESS', 'TBC', 'ASTHMA', 'TIDAK ADA/TIDAK SAKIT'];

        foreach ($penyakit as $value ) {
            Penyakit::create([
                'nama'=>$value
            ]);
        }
    }
}
