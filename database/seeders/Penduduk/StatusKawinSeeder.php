<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\Komponen\StatusKawin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKawinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusKawin = [
           'BELUM KAWIN', 'KAWIN','CERAI HIDUP', 'CERAI MATI'
        ];
        foreach ($statusKawin as $value ) {
            StatusKawin::create([
                'nama'=>$value
            ]);
        }
    }
}
