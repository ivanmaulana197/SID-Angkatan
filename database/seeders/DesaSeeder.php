<?php

namespace Database\Seeders;

use App\Models\InfoDesa\Desa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Desa::create([
            'nama'=>'Angkatan',
            'kode'=>'',
            'telp'=>'',
            'kecamatan'=>'Arjasa',
            'kabupaten'=>'Sumenep',
            'provinsi'=>'Jawa Timur',
            'alamat'=>'Jalan.Raya Angkatan kecamatan N0.109 arjasa kabupaten sumenep Kecamatan Arjasa Kabupaten Sumenep Provinsi Jawa Timur Kode Pos 69491',
            'logo'=>asset('logo-desa.png'),
            'id_kepala_desa'=>1, 
            'lokasi_desa'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63375.59711140346!2d115.192765238363!3d-6.893615234925741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dda99d572dc6531%3A0x80f2e285831dc153!2sAngkatan%2C%20Arjasa%2C%20Sumenep%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1684892329371!5m2!1sen!2sid" width="1200" height="800"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'lokasi_kantor_desa'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.185792274408!2d115.25678479999999!3d-6.8683273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dda971fec8376d3%3A0x3011af83c05e1e1e!2sKantor%20Desa%20Angkatan!5e0!3m2!1sen!2sid!4v1684892127096!5m2!1sen!2sid" width="1200" height="800" style="border:10;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
    }
}
