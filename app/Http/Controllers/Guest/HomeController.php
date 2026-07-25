<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Berita\Berita;
use App\Models\InformasiDesa\InformasiDesa;
use App\Models\Penduduk;
use App\Models\Penduduk\Komponen\Agama;
use App\Models\Penduduk\PendudukUmur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class HomeController extends MainController
{
    public function index()
    {
        // $data = $this->getDataGuest();
        
        $latestBerita = Berita::has('images')->where('status','PUBLISHED')->latest('updated_at')->get();
        $latestInformasiDesa = InformasiDesa::has('images')->where('status','PUBLISHED')->latest('updated_at')->get();
        $gambar = new Collection();
        $gambar = $gambar->concat($latestBerita);
        $gambar = $gambar->concat($latestInformasiDesa);
        // Urutkan data gambar berdasarkan waktu terakhir kali diupdate secara menurun (dari yang terbaru)
        $banner = $gambar->sortByDesc('updated_at')->values();
        $banner = $banner->take(5);
        // dd(class_basename($banner[0]));
        
        
        $beritas = Berita::where('status', 'PUBLISHED')
            ->latest()
            ->paginate(2);
        $informasiDesas = InformasiDesa::where('status', 'PUBLISHED')
            ->latest()
            ->paginate(2);
        
        return view('guest.home.index', compact('beritas', 'informasiDesas','banner'));
    }
}
