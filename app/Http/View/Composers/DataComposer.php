<?php

namespace App\Http\View\Composers;

use App\Models\Visitor;
use App\Models\Penduduk;
use Illuminate\View\View;
use App\Helpers\DateHelpers;
use App\Models\Agenda;
use App\Models\Berita\Berita;
use App\Models\InfoDesa\Desa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Berita\KategoriBerita;
use App\Models\Galeri;
use App\Models\LembagaDesa\LembagaDesa;
use App\Models\InformasiDesa\KategoriInformasiDesa;
use App\Models\Surat\PermohonanSurat;

class DataComposer
{
    public function compose(View $view)
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
        // $now = Carbon::now();
        // $agenda = Agenda::first();
        // dd($now < $agenda->tanggal_agenda);
        // dd($agenda->tanggal_agenda);

        $data['agenda'] = Agenda::latest('created_at')->get();
        $data['galeri']=Galeri::latest()->get();
        // dd($data['galeri']);

        $data['desa'] = Desa::find(1);
        
        // mengambil data statistik pengunjung
        $startDate = Carbon::now('Asia/Jakarta')->subDays(6); // Mengambil tanggal 7 hari yang lalu
        $endDate = Carbon::now('Asia/Jakarta');
        $visitors = Visitor::select(DB::raw('COUNT(*) as total_visitors'), DB::raw('DATE_FORMAT(visited_at, "%Y-%m-%d") as tanggal'))
            ->whereBetween('visited_at', [$startDate, $endDate])
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
        // $data['jml-permohonan-surat']=PermohonanSurat::all()->count();
        //ambil berita acak
        //data desa

        $data['kategori-berita'] = KategoriBerita::all();
        $data['kategori-informasi-desa'] = KategoriInformasiDesa::all();
        $data['lembaga-desa'] = LembagaDesa::all();
        



        $view->with('myData', $data);
    }
}