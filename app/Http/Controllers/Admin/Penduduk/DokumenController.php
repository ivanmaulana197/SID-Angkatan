<?php

namespace App\Http\Controllers\Admin\Penduduk;

use App\Models\Penduduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Penduduk\PendudukDokumen;
use App\Models\Penduduk\Komponen\JenisDokumen;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Penduduk $penduduk)
    {
        $dokumen = $penduduk->dokumen;
        
        return view('admin.dokumen.index', compact('dokumen','penduduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Penduduk $penduduk)
    {
        $jenisDokumen = JenisDokumen::all();
        return view('admin.dokumen.create',compact('penduduk','jenisDokumen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Penduduk $penduduk)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'id_jenis_dokumen'=>'required',
            'file'=>'required|image|mimes:png,jpg,jpeg|max:2048'
        ],[
            'max'=>'File Maksimal 2 MB',
            'image'=>'File harus berupa gambar dengan format jpg/jpeg/png',
            'mimes'=>'File harus berupa gambar dengan format jpg/jpeg/png'
        ]);

        if ($request->file('file')) {
            $nama_file = Str::uuid() . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file->storeAs('images/penduduk/'.$penduduk->NIK.'/dokumen', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
        }

        PendudukDokumen::create([
            'id_penduduk'=>$penduduk->id,
            'id_jenis_dokumen'=>$request->id_jenis_dokumen,
            'nama'=>$request->nama,
            'file'=>$url
        ]);

        return redirect(route('admin.kependudukan.dokumen',$penduduk->id))->with('success','Berhasil Menambahkan Dokumen');
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
    public function edit(Penduduk $penduduk, PendudukDokumen $dokumen)
    {
        $jenisDokumen = JenisDokumen::all();
        return view('admin.dokumen.edit',compact('penduduk','dokumen','jenisDokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk, PendudukDokumen $dokumen)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'id_jenis_dokumen'=>'required',
            'file'=>'image|mimes:png,jpg,jpeg|max:2048'
        ],[
            'max'=>'File Maksimal 2 MB',
            'image'=>'File harus berupa gambar dengan format jpg/jpeg/png',
            'mimes'=>'File harus berupa gambar dengan format jpg/jpeg/png'
        ]);

        if ($request->file('file')) {
            $pathFoto = str_replace(url('/storage'), '', $dokumen->file);
            Storage::delete($pathFoto);

            $nama_file = Str::uuid() . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file->storeAs('images/penduduk/'.$penduduk->NIK.'/dokumen', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $dokumen->update(['file' => $url]);
        }

        $dokumen->update([
            'id_jenis_dokumen'=>$request->id_jenis_dokumen,
            'nama'=>$request->nama,
        ]);
        return redirect(route('admin.kependudukan.dokumen',$penduduk->id))->with('success','Berhasil Mengupdate Dokumen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk, PendudukDokumen $dokumen)
    {
        $pathFoto = str_replace(url('/storage'), '', $dokumen->file);
        Storage::delete($pathFoto);
        $dokumen->delete();
        return redirect(route('admin.kependudukan.dokumen',$penduduk->id))->with('success','Berhasil Menghapus Dokumen');
    }
}
