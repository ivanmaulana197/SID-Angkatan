<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk\PendudukKondisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kondisi = [
            'MASIH HIDUP', 'MENINGGAL', 'PINDAH', 'TIDAK VALID'
        ];

        foreach ($kondisi as $value ) {
            PendudukKondisi::create([
                'nama'=>$value
            ]);
        }
    }
}
