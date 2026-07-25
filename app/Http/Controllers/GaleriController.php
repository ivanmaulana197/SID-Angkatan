<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'foto'=>'required|image|mimes:png,jpg,jpeg|max:5012'
        ]);

        // $request->file('foto');
        $gambar = $request->file('foto');
        // dd($gambar);
        $nama_file = Str::uuid() . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs('images/galeri', $nama_file);
        $url = Storage::url($path);
        Galeri::create([
            'nama'=>$request->nama,
            'foto'=>$url
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Berhasil menambahkan ke Galeri');
    }

    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show',compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit',compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'foto'=>'image|mimes:png,jpg,jpeg|max:5012'
        ]);

        if($request->file('foto')){
            $pathFoto = str_replace(url('/storage'), '', $galeri->foto);
            Storage::delete($pathFoto);

            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/galeri', $nama_file);
            $url = Storage::url($path);

            $galeri->update(['foto'=>$url]);
        }
        $galeri->update(['nama'=>$request->nama]);

        return redirect()->route('admin.galeri')->with('success', 'Berhasil mengedit data dari Galeri');
    }

    public function destroy(Galeri $galeri)
    {
        $pathFoto = str_replace(url('/storage'), '', $galeri->foto);
        Storage::delete($pathFoto);

        $galeri->delete();
        return redirect()->route('admin.galeri')->with('success', 'Berhasil menghapus data dari Galeri');
    }
}
