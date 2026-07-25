<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\Kecacatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CacatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecacatan = ['TIDAK CACAT', 'CACAT FISIK', 'CACAT NETRA/BUTA', 'CACAT RUNGU/WICARA', 'CACAT MENTAL/JIWA', 'CACAT FISIK DAN MENTAL', 'CACAT LAINNYA'];

        foreach ($kecacatan as $value) {
            Kecacatan::create([
                'nama' => $value,
            ]);
        }
    }
}
