<?php

namespace Database\Factories;

use App\Models\Penduduk;
use App\Models\Penduduk\PendudukUmur;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    protected $model = Penduduk::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->date($format='Y-m-d', $max='now');
        $usia = Carbon::parse($date)->age;
        $rentangUmur = PendudukUmur::all();
        $id_usia = '';
        foreach ($rentangUmur as $value) {
            if ($usia >= $value->dari && $usia <= $value->sampai) {
                $id_usia = $value->id;
                break;
            }
        }
        return [
            'nama' => $this->faker->name(),
            'NIK' => rand(pow(10, 15), pow(10, 16) - 1),
            'id_kk' => null,
            'jenisKelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tempatLahir' => $this->faker->city(),
            'tanggalLahir' => $date,
            'id_usia'=>$id_usia,
            'id_agama' => rand(1,7),
            'id_pendidikan_kk' => rand(1,25),
            'id_sedang_pendidikan' => rand(1,18),
            'id_pekerjaan' => rand(1,25),
            'id_status_kawin' => rand(1,4),
            'kewarganegaraan' => 'WNI',
            'nik_ayah' => rand(pow(10, 15), pow(10, 16) - 1),
            'nama_ayah' => $this->faker->firstNameMale(),
            'nik_ibu' => rand(pow(10, 15), pow(10, 16) - 1),
            'nama_ibu' => $this->faker->firstNameFemale(),
            'foto' => asset('img/profile-default.png'),
            'id_golongan_darah' => rand(1,13),
            'statusPenduduk' => $this->faker->randomElement(['Tetap', 'Tidak Tetap']),
            
            'alamat_sekarang' => $this->faker->address(),
            'id_dusun' => 1,
            'id_rw' => 1,
            'id_rt' => 1,
            'id_kondisi' => rand(1,6),
            'hamil' => 'Tidak HAMIL',
            'id_cacat' => 1,
            'id_penyakit' => 1,
            'no_akta_kelahiran' => $this->faker->randomNumber(),
            'created_by'=>1,
            'id_hubungan' => rand(1,11),
        ];
    }
}
