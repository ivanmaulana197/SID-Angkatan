<?php

namespace App\Http\Controllers\Admin\Berita;

use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use App\Models\Berita\GambarBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GambarBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Berita $berita)
    {
        return view('admin.berita.gambar.index', compact('berita'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Berita $berita, Request $request)
    {
        $validated = $request->validate([
            'gambar'=>'required|file|image|mimes:jpeg,png,jpg,gif,svg',
            // 'gambar.*' => 'images|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $gambar = $request->file('gambar');
        // dd($gambar);
        $nama_file = Str::uuid() . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs('images/berita/' . $berita->slug, $nama_file);
        $url = Storage::url($path);

        //menyimpan gambar
        GambarBerita::create([
            'url'=>$url,
            'path' => $path, //{{ Storage::url($image->path) }} cara manggilnya
            'id_berita' => $berita->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Gambar');
    }

    public function destroy(Berita $berita, $id)
    {
        $gambar = GambarBerita::find($id);
        if(count($berita->images) == 1){
            Storage::deleteDirectory(dirname($gambar->path));
        }else{
            Storage::delete($gambar->path);
        }
        $gambar->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Gambar');    
    }
}
