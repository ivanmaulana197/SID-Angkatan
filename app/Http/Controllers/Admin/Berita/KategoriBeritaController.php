<?php

namespace App\Http\Controllers\Admin\Berita;

use App\Http\Controllers\Controller;
use App\Models\Berita\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function create()
    {
        return view('admin.berita.kategori.create');
    }

    public function store(Request $request)
    {
        // dd($request->slug);
        $validated = $request->validate([
            'nama' => 'required|unique:kategori_berita,nama',
        ]);
        $slug = Str::slug($request->nama);
        $kategori = KategoriBerita::create([
            'nama' => $request->nama,
            'slug' => $slug,
        ]);

        if ($kategori->id == 1) {
            return redirect()
                ->route('admin.berita.create')
                ->with('success', 'Berhasil Menambahkan Kategori');
        } else {
            return redirect(route('admin.berita'))->with('success', 'Kategori Berita Berhasil ditambahkan');
        }
    }

    public function edit(KategoriBerita $kategoriBerita)
    {
        return view('admin.berita.kategori.edit', compact('kategoriBerita'));
    }

    public function update(Request $request, KategoriBerita $kategoriBerita)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:kategori_berita,nama,' . $kategoriBerita->id,
        ]);
        $slug = Str::slug($request->nama);
        $kategoriBerita->update(['nama' => $request->nama, 'slug' => $slug]);
        return redirect(route('admin.berita'))->with('success', 'Kategori Berhasil di Update');
    }

    public function destroy(KategoriBerita $kategoriBerita)
    {
        $kategoriBerita->berita()->delete();
        $kategoriBerita->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Kategori berhasil dihapus');
    }

    public function cekSlug(Request $request)
    {
        $slug = Str::slug($request->input('nama'));
        return response()->json(['slug' => $slug]);
    }
}
