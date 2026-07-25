<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\PendudukHubungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HubunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hubungan = [
            'KEPALA KELUARGA', 'SUAMI', 'ISTRI', 'ANAK','MENANTU','CUCU','ORANG TUA','MERTUA', 'FAMILI LAIN','PEMBANTU', 'LAINNYA'
        ];

        foreach ($hubungan as $value ) {
            PendudukHubungan::create([
                'nama'=>$value
            ]);
        }
    }
}
