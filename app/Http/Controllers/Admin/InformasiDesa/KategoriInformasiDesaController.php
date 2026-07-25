<?php

namespace App\Http\Controllers\Admin\InformasiDesa;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InformasiDesa\KategoriInformasiDesa;

class KategoriInformasiDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.informasi-desa.kategori.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->slug);
        $validated = $request->validate([
            'nama' => 'required|unique:kategori_informasi_desa,nama',
        ]);
        $slug = Str::slug($request->nama);
        $kategori = KategoriInformasiDesa::create([
            'nama' => $request->nama,
            'slug' => $slug,
        ]);
        
        if($kategori->id == 1){
            return redirect()->route('admin.informasi-desa.create')->with('success', 'Berhasil Menambahkan Kategori');

        }else{
            return redirect(route('admin.informasi-desa'))->with('success', 'Kategori Informasi Desa Berhasil ditambahkan');
        }
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
    public function edit(KategoriInformasiDesa $kategoriInformasiDesa)
    {
        return view('admin.informasi-desa.kategori.edit', compact('kategoriInformasiDesa'));
    }

    public function update(Request $request, KategoriInformasiDesa $kategoriInformasiDesa)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:kategori_informasi_desa,nama,' . $kategoriInformasiDesa->id,
            
        ]);
        $slug = Str::slug($request->nama);
        $kategoriInformasiDesa->update([
            'nama' => $request->nama,
            'slug' => $slug,
        ]);
        return redirect(route('admin.informasi-desa'))->with('success', 'Kategori Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriInformasiDesa $kategoriInformasiDesa)
    {
        $kategoriInformasiDesa->informasi_desa()->delete();
        $kategoriInformasiDesa->delete();

        return redirect()
            ->route('admin.informasi-desa')
            ->with('success', 'Kategori berhasil dihapus');
    }

    public function cekSlug(Request $request)
    {
        $slug = Str::slug($request->input('nama'));
        return response()->json(['slug' => $slug]);
    }
}
