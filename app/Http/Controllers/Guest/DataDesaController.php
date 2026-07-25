<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\Penduduk;
use App\Models\Penduduk\Komponen\Agama;
use App\Models\Penduduk\Komponen\Pekerjaan;
use App\Models\Penduduk\Komponen\Pendidikan;
use App\Models\Penduduk\Komponen\PendidikanKK;
use App\Models\Penduduk\PendudukUmur;
use Illuminate\Http\Request;

class DataDesaController extends MainController
{
    public function dataWilayahAdministratif()
    {
        $dusun = Dusun::all();
        return view('guest.data-desa.data-wilayah-administratif',compact('dusun'));
    }

    public function dataJenisKelamin()
    {
        $jk = Penduduk::selectRaw('SUM(CASE WHEN jenisKelamin = "Laki-laki" THEN 1 ELSE 0 END) AS "Laki-Laki", SUM(CASE WHEN jenisKelamin = "Perempuan" THEN 1 ELSE 0 END) AS "Perempuan"')
            ->first()
            ->toArray();
        // dd($jk);
        return view('guest.data-desa.data-jenis-kelamin', compact('jk'));
    }

    public function dataAgama()
    {
        // $agama = Agama::leftJoin('penduduk', 'agama.id', '=', 'penduduk.id_agama')
        //     ->selectRaw('agama.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
        //     ->groupBy('agama.nama')->orderBy('agama.id', 'asc')
        //     ->get();
        $agama = Agama::leftJoin('penduduk', 'agama.id', '=', 'penduduk.id_agama')
        ->selectRaw('agama.id, agama.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
        ->groupBy('agama.id','agama.nama')->orderBy('agama.id', 'asc')
        ->get();
        // dd($agama);

        return view('guest.data-desa.data-agama', compact('agama'));
    }

    public function dataPendidikanDalamKK()
    {
        $data = PendidikanKK::leftJoin('penduduk', 'pendidikan_kk.id', '=', 'penduduk.id_pendidikan_kk')
            ->selectRaw('pendidikan_kk.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('pendidikan_kk.id','pendidikan_kk.nama')->orderBy('pendidikan_kk.id', 'asc')
            ->get();

        return view('guest.data-desa.data-pendidikan-dalam-kk',compact('data'));
    }

    public function dataPendidikan()
    {
        $data = Pendidikan::leftJoin('penduduk', 'pendidikan.id', '=', 'penduduk.id_sedang_pendidikan')
            ->selectRaw('pendidikan.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('pendidikan.id','pendidikan.nama')->orderBy('pendidikan.id', 'asc')
            ->get();

        return view('guest.data-desa.data-pendidikan',compact('data'));
    }

    public function dataPekerjaan()
    {
        $data = Pekerjaan::leftJoin('penduduk', 'pekerjaan.id', '=', 'penduduk.id_pekerjaan')
            ->selectRaw('pekerjaan.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('pekerjaan.id','pekerjaan.nama')->orderBy('pekerjaan.id', 'asc')
            ->get();
        
        return view('guest.data-desa.data-pekerjaan',compact('data'));
    }

    public function dataUsia()
    {
        $data = PendudukUmur::leftJoin('penduduk', 'penduduk_umur.id', '=', 'penduduk.id_usia')
            ->selectRaw('penduduk_umur.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('penduduk_umur.id','penduduk_umur.nama')->orderBy('penduduk_umur.id', 'asc')
            ->get();
            return view('guest.data-desa.data-usia',compact('data'));
    }

   
}
