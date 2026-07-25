<?php

namespace Database\Seeders\Penduduk;

use App\Models\Penduduk;
use App\Models\Penduduk\PendudukLayananMandiri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $penduduk = Penduduk::create([
        //     'nama' => 'Suhat',
        //     'NIK' => '5271042704010003',
        //     'id_kk' => null,
        //     'jenisKelamin' => 'Laki-laki',
        //     'tempatLahir' => 'Mataram',
        //     'tanggalLahir' => date('Y-m-d',strtotime('2001-03-02')),
        //     'id_agama' => 1,
        //     'id_pendidikan_kk' => 1,
        //     'id_sedang_pendidikan' => 1,
        //     'id_pekerjaan' => 1,
        //     'id_status_kawin' => 1,
        //     'kewarganegaraan' => 'WNI',
        //     'nik_ayah' => '',
        //     'nama_ayah' => 'NAAM AYAH',
        //     'nik_ibu' => '',
        //     'nama_ibu' => 'NAMA IBUU',
        //     'foto' => asset('img/profile-default.png'),
        //     'id_golongan_darah' => 1,
        //     'statusPenduduk' => 'Tetap',
            
        //     'alamat_sekarang' => 'jalan yang pernah ada',
        //     'id_dusun' => 1,
        //     'id_rw' => 1,
        //     'id_rt' => 1,
        //     'id_kondisi' => 1,
        //     'hamil' => 'Tidak HAMIL',
        //     'id_cacat' => 1,
        //     'id_penyakit' => 1,
        //     'no_akta_kelahiran' => '1342',
        //     'created_by'=>1,
        //     'id_hubungan' => 1,
        //     'id_asuransi' => 1,
        // ]);
        // Penduduk::factory(100)->create();
        // $layanan = PendudukLayananMandiri::create([
        //     'pin'=>'123456',
        //     'terakhir_login'=>now(),
        //     'id_penduduk'=>1,
        // ]);
        // $layanan->assignRole('user');
    }
}
