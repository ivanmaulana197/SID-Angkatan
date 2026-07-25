<?php

namespace App\Http\Controllers\Admin\Berita;

use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use App\Models\Berita\GambarBerita;
use App\Models\Berita\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $kategori = KategoriBerita::latest('updated_at')->get();
        $berita = Berita::latest('updated_at')->get();
        

        return view('admin.berita.index', compact('kategori', 'berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::latest('updated_at')->get();
        
        if(count($kategori)==0){
            return redirect()->route('admin.berita.kategori.create')->with('tambahKategoriDulu', 'Tambahkan Kategori Berita Terlebih Dahulu');
        }
        return view('admin.berita.create', compact('kategori'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|unique:berita,judul',
            // 'slug' => 'required|unique:berita,slug',
            'id_kategori' => 'required',
            'isi_berita' => 'required',
            // 'status' => ['required', Rule::in(Berita::$enumFields['status'])],
            'gambar.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ],[
            'gambar.*.image' => 'File yang diupload harus bertipe Gambar: jpeg,png,jpg,gif,svg',
            // pesan validasi lainnya
        ]
    );
        $slug = Str::slug($request->judul);

        $berita = Berita::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'id_kategori' => $request->id_kategori,
            'id_user' => auth()->user()->id,
            'isi_berita' => $request->isi_berita,
            'status' => $request->status,
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                //mengambil path dan menyimpannya
                $nama_file = Str::uuid().'.' . $image->getClientOriginalExtension();
                
                $path = $image->storeAs('images/berita/'.$berita->slug, $nama_file);
                // Buat symlink dari folder storage/app/public ke public/storage
                $url = Storage::url($path);
                
                //menyimpan gambar
                GambarBerita::create([
                    'url' => $url,
                    'path' => $path, //{{ Storage::url($image->path) }} cara manggilnya
                    'id_berita' => $berita->id,
                ]);
            }
        }

        return redirect()->route('admin.berita')->with('success', 'Berhasil Menambahkan Berita');
    }

    public function show(Berita $berita)
    {
        $berita->increment('diakses');
        return view('admin.berita.show', compact('berita'));
    }


    public function edit(Berita $berita)
    {
        $kategori = KategoriBerita::all();
        // dd($berita->enumFields['status']);
        return view('admin.berita.update',compact('kategori', 'berita'));
    }

    public function update(Berita $berita, Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|unique:berita,judul,'.$berita->id,
            // 'slug' => 'required|unique:berita,slug',
            'id_kategori' => 'required',
            'isi_berita' => 'required',
            // 'status' => ['required', Rule::in(Berita::$enumFields['status'])],
            // 'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $berita->update([
            'judul'=> $request->judul,
            'slug'=> Str::slug($request->judul),
            'isi_berita'=>$request->isi_berita,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.berita')->with('success','Berhasil Mengupdate Berita');
    }

    public function destroy(Berita $berita)
    {   
        Storage::deleteDirectory(dirname($berita->images[0]->path));
        
        $berita->images()->delete();
        $berita->delete();
        return redirect()->route('admin.berita')->with('success','Berhasil Menghapus Berita');
    }

    

    public function cekSlug(Request $request)
    {
        $slug = Str::slug($request->input('judul'));
        return response()->json(['slug' => $slug]);
    }
}
