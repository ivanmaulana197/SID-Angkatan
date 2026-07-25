<?php

namespace App\Imports;

use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\InfoDesa\WilayahAdministratif\RT;
use App\Models\InfoDesa\WilayahAdministratif\RW;
use App\Models\Penduduk;
use App\Models\Penduduk\PendudukKartuKeluarga;
use App\Models\Penduduk\PendudukUmur;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\HeadingRowImport;

class PendudukImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        if ($row['nama_lengkap'] !== 'nama_lengkap') {
            // dd($row);
            DB::beginTransaction();
            $tgl_lahir = date('Y-m-d', strtotime($row['tanggal_lahir']));
            $usia = Carbon::parse($tgl_lahir)->age;
            $rentangUmur = PendudukUmur::all();
            $id_usia = '';
            foreach ($rentangUmur as $value) {
                if ($usia >= $value->dari && $usia <= $value->sampai) {
                    $id_usia = $value->id;
                    break;
                }
            }

            $dusun = Dusun::where('nama', $row['dusun'])->first();
            if (!$dusun) {
                $dusun = Dusun::create([
                    'nama' => $row['dusun'],
                ]);
            }

            $rw = $dusun->rw->where('rw', $row['rw'])->first();
            if (!$rw) {
                $rw = RW::create([
                    'rw' => $row['rw'],
                    'id_dusun' => $dusun->id,
                ]);
            }

            $rt = $rw->rt->where('rt', $row['rt'])->first();
            if (!$rt) {
                $rt = RT::create([
                    'rt' => $row['rt'],
                    'id_rw' => $rw->id,
                ]);
            }

            $jenis_kelamin = $row['jenis_kelamin'] == '1'?'Laki-laki':'Perempuan';
            

            $penduduk =Penduduk::create([
                'nama' => $row['nama_lengkap'],
                'NIK' => $row['nik'],
                'id_kk' => null,
                'jenisKelamin' => $row['jenis_kelamin']=='1'?'Laki-laki':'Perempuan' ?? null ,
                'tempatLahir' => $row['tempat_lahir'],
                'tanggalLahir' => $tgl_lahir,
                'id_usia' => $id_usia,
                'id_agama' => $row['agama'],
                'id_pendidikan_kk' => $row['pendidikan_dalam_kk'],
                'id_sedang_pendidikan' => $row['pendidikan_sedang_ditempuh'],
                'id_pekerjaan' => $row['pekerjaan'],
                'id_status_kawin' => $row['status_perkawinan'],
                'kewarganegaraan' => $row['kewarganegaraan'],
                'nik_ayah' => null,
                'nama_ayah' => $row['nama_ayah'],
                'nik_ibu' => null,
                'nama_ibu' => $row['nama_ibu'],
                'foto' => asset('img/profile-default.png'),
                'id_golongan_darah' => $row['golongan_darah'],
                'statusPenduduk' => 'Tetap',

                'alamat_sekarang' => $row['alamat'],
                'id_dusun' => $dusun->id,
                'id_rw' => $rw->id,
                'id_rt' => $rt->id,
                'id_kondisi' => 1,
                'hamil' => $row['hamil'],
                'id_cacat' => $row['cacat'],
                'id_penyakit' => $row['penyakit'],
                'no_akta_kelahiran' => $row['akta_lahir'],
                'created_by' => auth()->user()->id,
                'id_hubungan' => $row['status_hubungan_dalam_keluarga'],
            ]);
            // dd($penduduk);
            $kk = PendudukKartuKeluarga::where('no_kk', $row['no_kk'])->first();
            if ($kk) {
                if (!$kk->id_penduduk) {
                    $kk->update([
                        'id_penduduk' => $penduduk->id_hubungan == 1 ? $penduduk->id : null,
                    ]);
                }
            } else {
                $kk = PendudukKartuKeluarga::create([
                    'no_kk' => $row['no_kk'],
                    'id_penduduk' => $penduduk->id_hubungan == 1 ? $penduduk->id : null,
                ]);
            }
            $penduduk->id_kk = $kk->id;
            $penduduk->save();

            DB::commit();
            return $penduduk;
        }
        return null;
    }
}
