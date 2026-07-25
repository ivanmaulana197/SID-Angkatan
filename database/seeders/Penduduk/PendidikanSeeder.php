<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\Pendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikan = ['BELUM MASUK TK/KELOMPOK BERMAIN', 'SEDANG TK/KELOMPOK BERMAIN', 'TIDAK PERNAH SEKOLAH', 'SEDANG SD/SEDERAJAT', 'TIDAK TAMAT SD/SEDERAJAT', 'SEDANG SLTP/SEDERAJAT', 'SEDANG SLTA/SEDERAJAT', 'SEDANG D-1/SEDERAJAT', 'SEDANG D-2/SEDERAJAT', 'SEDANG D-3/SEDERAJAT', 'SEDANG S-1/SEDERAJAT', 'SEDANG S-2/SEDERAJAT', 'SEDANG S-3/SEDERAJAT', 'SEDANG SLB A/SEDERAJAT', 'SEDANG SLB B/SEDERAJAT', 'SEDANG SLB C/SEDERAJAT', 'TIDAK DAPAT MEMBACA DAN MENULIS HURUF LATIN/ARAB', 'TIDAK SEDANG SEKOLAH'];

        foreach ($pendidikan as $value ) {
            Pendidikan::create([
                'nama'=>$value
            ]);
        }
    }
}
