<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Models\Berita\Berita;
use App\Http\Controllers\Controller;
use App\Models\Penduduk\PendudukUmur;
use App\Models\LembagaDesa\LembagaDesa;
use App\Models\Penduduk\Komponen\Agama;
use App\Models\InformasiDesa\InformasiDesa;
use App\Models\Penduduk\Komponen\Pekerjaan;
use App\Models\Penduduk\Komponen\Pendidikan;
use App\Models\Penduduk\PendudukKartuKeluarga;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;

class DashboardController extends Controller
{
    public function index()
    {
        $data['penduduk'] = Penduduk::all()->count();
        $data['kk'] = PendudukKartuKeluarga::all()->count();
        $data['dusun'] = Dusun::all()->count();
        $data['lembaga'] = LembagaDesa::all()->count();

        //media
        $data['berita'] = Berita::count();
        $data['info-desa'] = InformasiDesa::count();
        $data['agenda'] = Agenda::count();
        $data['galeri'] = Galeri::count();

        $data['jk'] = Penduduk::selectRaw('SUM(CASE WHEN jenisKelamin = "Laki-laki" THEN 1 ELSE 0 END) AS "Laki-Laki", SUM(CASE WHEN jenisKelamin = "Perempuan" THEN 1 ELSE 0 END) AS "Perempuan"')
            ->first()
            ->toArray();

        $data['agama'] = Agama::leftJoin('penduduk', 'agama.id', '=', 'penduduk.id_agama')
            ->selectRaw('agama.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('agama.id','agama.nama')
            ->orderBy('agama.id', 'asc')
            ->get();
        $data['pendidikan'] = Pendidikan::leftJoin('penduduk', 'pendidikan.id', '=', 'penduduk.id_sedang_pendidikan')
            ->selectRaw('pendidikan.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('pendidikan.id','pendidikan.nama')
            ->orderBy('pendidikan.id', 'asc')
            ->get();
        $data['pekerjaan'] = Pekerjaan::leftJoin('penduduk', 'pekerjaan.id', '=', 'penduduk.id_pekerjaan')
            ->selectRaw('pekerjaan.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('pekerjaan.id','pekerjaan.nama')
            ->orderBy('pekerjaan.id', 'asc')
            ->get();
        $data['usia'] = PendudukUmur::leftJoin('penduduk', 'penduduk_umur.id', '=', 'penduduk.id_usia')
            ->selectRaw('penduduk_umur.nama, COALESCE(COUNT(penduduk.id), 0) as jumlah')
            ->groupBy('penduduk_umur.id','penduduk_umur.nama')
            ->orderBy('penduduk_umur.id', 'asc')
            ->get();
        // dd($data);
        return view('admin.dashboard.index', compact('data'));
    }
}
