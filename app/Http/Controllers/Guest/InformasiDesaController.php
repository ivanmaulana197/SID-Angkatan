<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\InformasiDesa\InformasiDesa;
use App\Models\InformasiDesa\KategoriInformasiDesa;
use App\Models\User;
use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;

class InformasiDesaController extends Controller
{
    public function index()
    {
        $informasiDesa = InformasiDesa::where('status','PUBLISHED')->latest()
        ->paginate(6);
        $kategori = KategoriInformasiDesa::all();
        return view('guest.informasi-desa.index',compact('informasiDesa','kategori'));
    }

    public function kategori(KategoriInformasiDesa $kategoriInformasiDesa)
    {
        
        $informasiDesa = $kategoriInformasiDesa->informasi_desa()->where('status','PUBLISHED')->latest()
        ->paginate(6);
        $kategori = KategoriInformasiDesa::all();
        return view('guest.informasi-desa.index',compact('kategoriInformasiDesa','informasiDesa','kategori'));
    }

    public function dibuatOleh(User $user)
    {
        $informasiDesa = $user->informasiDesa()->where('status','PUBLISHED')->latest()
        ->paginate(6);
        $createdBy = $user;
        $kategori = KategoriInformasiDesa::all();
        return view('guest.informasi-desa.index',compact('createdBy','ke','kategori'));
    }

    public function show(InformasiDesa $informasiDesa)
    {
        // dd($berita->images);
        $informasiDesa->increment('diakses');
        return view('guest.informasi-desa.show',compact('informasiDesa'));
    }
}
