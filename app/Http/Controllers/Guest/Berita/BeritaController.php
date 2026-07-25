<?php

namespace App\Http\Controllers\Guest\Berita;

use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use App\Models\Berita\KategoriBerita;
use App\Models\User;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::where('status','PUBLISHED')->latest()
        ->paginate(6);
        $kategori = KategoriBerita::all();
        return view('guest.berita.index',compact('berita','kategori'));
    }

    public function kategori(KategoriBerita $kategoriBerita)
    {
        $berita = $kategoriBerita->berita()->where('status','PUBLISHED')->latest()
        ->paginate(6);
        $kategori = KategoriBerita::all();
        return view('guest.berita.index',compact('kategoriBerita','berita','kategori'));
    }

    public function dibuatOleh(User $user)
    {
        $berita = $user->berita()->where('status','PUBLISHED')->latest()
        ->paginate(6);
        $createdBy = $user;
        $kategori = KategoriBerita::all();
        return view('guest.berita.index',compact('createdBy','berita','kategori'));
    }

    public function show(Berita $berita)
    {
        // dd($berita->images);
        $berita->increment('diakses');
        return view('guest.berita.show',compact('berita'));
    }
    
}
