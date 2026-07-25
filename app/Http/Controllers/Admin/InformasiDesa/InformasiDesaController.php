<?php

namespace App\Http\Controllers\Admin\InformasiDesa;

use App\Http\Controllers\Controller;
use App\Models\InformasiDesa\GambarInformasiDesa;
use App\Models\InformasiDesa\InformasiDesa;
use App\Models\InformasiDesa\KategoriInformasiDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriInformasiDesa::latest('updated_at')->get();
        $informasiDesa = InformasiDesa::latest('updated_at')->get();
        

        return view('admin.informasi-desa.index', compact('kategori', 'informasiDesa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriInformasiDesa::latest('updated_at')->get();
        
        if(count($kategori)==0){
            return redirect()->route('admin.informasi-desa.kategori.create')->with('tambahKategoriDulu', 'Tambahkan Kategori Informasi Desa Terlebih Dahulu');
        }
        return view('admin.informasi-desa.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|unique:informasi_desa,judul',
            // 'slug' => 'required|unique:berita,slug',
            'id_kategori' => 'required',
            'isi_informasi_desa' => 'required',
            // 'status' => ['required', Rule::in(Berita::$enumFields['status'])],
            'gambar.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ],[
            'gambar.*.image' => 'File yang diupload harus bertipe Gambar: jpeg,png,jpg,gif,svg',
            // pesan validasi lainnya
        ]
    );
        $slug = Str::slug($request->judul);

        $informasiDesa = InformasiDesa::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'id_kategori' => $request->id_kategori,
            'id_user' => auth()->user()->id,
            'isi_informasi_desa' => $request->isi_informasi_desa,
            'status' => $request->status,
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                //mengambil path dan menyimpannya
                $nama_file = Str::uuid().'.' . $image->getClientOriginalExtension();
                
                $path = $image->storeAs('images/informasi-desa/'.$informasiDesa->slug, $nama_file);
                // Buat symlink dari folder storage/app/public ke public/storage
                $url = Storage::url($path);
                
                //menyimpan gambar
                GambarInformasiDesa::create([
                    'url' => $url,
                    'path' => $path, //{{ Storage::url($image->path) }} cara manggilnya
                    'id_informasi_desa' => $informasiDesa->id,
                ]);
            }
        }

        return redirect()->route('admin.informasi-desa')->with('success', 'Berhasil Menambahkan Informasi Desa');

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
    public function edit(InformasiDesa $informasiDesa)
    {
        $kategori = KategoriInformasiDesa::all();
        // dd($berita->enumFields['status']);
        return view('admin.informasi-desa.update',compact('kategori', 'informasiDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformasiDesa $informasiDesa, Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|unique:informasi_desa,judul,'.$informasiDesa->id,
            // 'slug' => 'required|unique:berita,slug',
            'id_kategori' => 'required',
            'isi_informasi_desa' => 'required',
            // 'status' => ['required', Rule::in(Berita::$enumFields['status'])],
            // 'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $informasiDesa->update([
            'judul'=> $request->judul,
            'slug'=> Str::slug($request->judul),
            'isi_informasi_desa'=>$request->isi_informasi_desa,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.informasi-desa')->with('success','Berhasil Mengupdate Informasi Desa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiDesa $informasiDesa)
    {
        
        // foreach ($informasiDesa->images as  $gambar) {
        //     $directory = dirname($gambar->path);
        //     dd($directory);
        //     // Storage::delete($gambar->path);
        // }
        Storage::deleteDirectory(dirname($informasiDesa->images[0]->path));
        
        $informasiDesa->images()->delete();
        $informasiDesa->delete();
        return redirect()->route('admin.informasi-desa')->with('success','Berhasil Menghapus Informasi Desa');
    }

    public function cekSlug(Request $request)
    {
        $slug = Str::slug($request->input('judul'));
        return response()->json(['slug' => $slug]);
    }
}
