<?php

namespace App\Http\Controllers\Admin\InformasiDesa;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\InformasiDesa\InformasiDesa;
use App\Models\InformasiDesa\GambarInformasiDesa;

class GambarInformasiDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InformasiDesa $informasiDesa)
    {
        return view('admin.informasi-desa.gambar.index', compact('informasiDesa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformasiDesa $informasiDesa, Request $request)
    {
        $validated = $request->validate([
            'gambar'=>'required|file|image|mimes:jpeg,png,jpg,gif,svg',
            // 'gambar.*' => 'images|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $gambar = $request->file('gambar');
        dd($gambar);
        // dd($gambar);
        $nama_file = Str::uuid() . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs('images/informasi-desa/' . $informasiDesa->slug, $nama_file);
        $url = Storage::url($path);

        //menyimpan gambar
        GambarInformasiDesa::create([
            'url'=>$url,
            'path' => $path, //{{ Storage::url($image->path) }} cara manggilnya
            'id_informasi_desa' => $informasiDesa->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Gambar');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiDesa $informasiDesa, $id)
    {
        $gambar = GambarInformasiDesa::find($id);
        if(count($informasiDesa->images) == 1){
            Storage::deleteDirectory(dirname($gambar->path));
        }else{
            Storage::delete($gambar->path);
        }
        $gambar->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Gambar');    
    }
}
