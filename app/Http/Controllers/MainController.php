<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelpers;
use App\Models\Berita\Berita;
use App\Models\Berita\KategoriBerita;
use App\Models\InfoDesa\Desa;
use App\Models\InformasiDesa\KategoriInformasiDesa;
use App\Models\LembagaDesa\LembagaDesa;
use App\Models\Penduduk;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function getDataGuest()
    {
        // data statistik penduduk
        $data['statistik'] = Penduduk::selectRaw('count(*) as jumlah_penduduk, SUM(CASE WHEN jenisKelamin = "Laki-laki" THEN 1 ELSE 0 END) AS jumlahLakiLaki, SUM(CASE WHEN jenisKelamin = "Perempuan" THEN 1 ELSE 0 END) AS jumlahPerempuan')
            ->first()
            ->toArray();

        //ambil berita terpopuler
        $data['berita-terpopuler'] = Berita::where('status', 'PUBLISHED')
            ->orderBy('diakses', 'desc')
            ->take(5)
            ->get();
        //ambil berita terbaru
        $data['berita-terbaru'] = Berita::where('status', 'PUBLISHED')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        // ambil berita acak
        $data['berita-acak'] = Berita::where('status', 'PUBLISHED')
            ->inRandomOrder()
            ->take(5)
            ->get();

        $data['desa'] = Desa::find(1);
        
        // mengambil data statistik pengunjung
        $startDate = Carbon::now()->subDays(6); // Mengambil tanggal 7 hari yang lalu
        $endDate = Carbon::now();
        $visitors = Visitor::select(DB::raw('COUNT(*) as total_visitors'), DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->get()
            ->pluck('total_visitors', 'tanggal')
            ->toArray();
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $tanggal = DateHelpers::tgl_indo($formattedDate);
            $data['pengunjung']['label-tanggal'][] = $tanggal;
            $data['pengunjung']['jumlah-pengunjung'][] = $visitors[$formattedDate] ?? 0;
        }
        $data['pengunjung-semua'] = Visitor::count();

        //ambil berita acak
        //data desa

        $data['kategori-berita'] = KategoriBerita::all();
        $data['kategori-informasi-desa'] = KategoriInformasiDesa::all();
        $data['lembaga-desa'] = LembagaDesa::all();
        return $data;
    }
}
