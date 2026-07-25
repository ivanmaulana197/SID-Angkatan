<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\PendidikanKK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanKKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikanKK = ['TIDAK / BELUM SEKOLAH', 'BELUM TAMAT SD/SEDERAJAT', 'TAMAT SD / SEDERAJAT', 'SLTP/SEDERAJAT', 'SLTA / SEDERAJAT', 'DIPLOMA I / II', 'AKADEMI/ DIPLOMA III/S. MUDA', 'DIPLOMA IV/ STRATA I', 'STRATA II', 'STRATA III'];
        foreach ($pendidikanKK as $value ) {
            PendidikanKK::create([
                'nama'=>$value
            ]);
        }
    }
}
