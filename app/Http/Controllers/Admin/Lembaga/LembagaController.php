<?php

namespace App\Http\Controllers\Admin\Lembaga;

use App\Models\Penduduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LembagaDesa\AnggotaLembaga;
use App\Models\LembagaDesa\LembagaDesa;
use Illuminate\Support\Facades\Storage;

class LembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lembaga = LembagaDesa::all();
        return view('admin.lembaga.index',compact('lembaga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduk = Penduduk::all();
        return view('admin.lembaga.create',compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=>'required|unique:lembaga_desa,nama',
            'logo'=>'file|image|mimes:png,jpg,svg',
            'deskripsi'=>'required'
        ],[
            'required'=>'Kolom ini wajib diisi'
        ]);

        $slug = Str::slug($request->nama);

        $lembaga = LembagaDesa::create([
            'nama'=>$request->nama,
            'slug'=>$slug,
            'deskripsi'=>$request->deskripsi,
            'logo'=>asset('img/profile-default.png')
        ]);

        if ($request->file('logo')) {

            $nama_file = Str::uuid() . '.' . $request->logo->getClientOriginalExtension();
            $path = $request->logo->storeAs('images/lembaga', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $lembaga->update(['logo'=>$url]);
        }
        if($request->id_ketua_lembaga){
            $anggota = AnggotaLembaga::create([
                'id_penduduk'=>$request->id_ketua_lembaga,
                'id_lembaga'=>$lembaga->id,
                'foto'=>asset('img/profile-default.png'),
                'jabatan'=>'KETUA',
                'keterangan'=>''
            ]);
            $lembaga->update([
                'id_ketua_lembaga'=>$request->id_ketua_lembaga
            ]);
        }
        return redirect()->route('admin.lembaga')->with('success','Berhasil Menambahkan Lembaga');
    }

    /**
     * Display the specified resource.
     */
    public function show(LembagaDesa $lembaga)
    {
        return view('admin.lembaga.show',compact('lembaga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LembagaDesa $lembaga)
    {
        if ($lembaga->ketuaLembaga) {
            $penduduk = Penduduk::whereNot('id', $lembaga->ketuaLembaga->id)->get();
        } else {
            $penduduk = Penduduk::all();
        }
        return view('admin.lembaga.edit',compact('lembaga','penduduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LembagaDesa $lembaga)
    {
        $validate = $request->validate([
            'nama'=>'required|unique:lembaga_desa,nama,'.$lembaga->id,
            'logo'=>'file|image|mimes:png,jpg,svg',
            'deskripsi'=>'required'
        ],[
            'required'=>'Kolom ini wajib diisi'
        ]);
        $slug = Str::slug($request->nama);

        if($request->file('logo')){
            $pathlogo = str_replace(url('/storage'), '', $lembaga->logo);
            Storage::delete($pathlogo);

            $nama_file = Str::uuid() . '.' . $request->logo->getClientOriginalExtension();
            $path = $request->logo->storeAs('images/lembaga', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $lembaga->update(['logo' => $url]);
        }

        if($request->id_ketua_lembaga){
            $ketuaDulu = $lembaga->anggotaLembaga()->where('jabatan','KETUA')->first();
            if($ketuaDulu){
                $ketuaDulu->update(['jabatan'=>'ANGGOTA']);
            }
            $anggota = AnggotaLembaga::create([
                'id_penduduk'=>$request->id_ketua_lembaga,
                'id_lembaga'=>$lembaga->id,
                'foto'=>asset('img/profile-default.png'),
                'jabatan'=>'KETUA',
                'keterangan'=>''
            ]);
            $lembaga->update(['id_ketua_lembaga'=>$request->id_ketua_lembaga]);
        }
        $lembaga->update([
            'nama'=>$request->nama,
            'slug'=>$slug,
            'deskripsi'=>$request->deskripsi
        ]);
        return redirect()->route('admin.lembaga')->with('success','Berhasil Mengedit Lembaga');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LembagaDesa $lembaga)
    {
        $pathlogo = str_replace(url('/storage'), '', $lembaga->logo);
        Storage::delete($pathlogo);

        $lembaga->anggotaLembaga()->delete();
        $lembaga->delete();
        return redirect()->route('admin.lembaga')->with('success','Berhasil Menghapus Lembaga');
    }

    public function createAnggota(LembagaDesa $lembaga)
    {
        if($lembaga->ketuaLembaga){
            $penduduk = Penduduk::whereNot('id',$lembaga->ketuaLembaga->id)->get();
        }else{
            $penduduk = Penduduk::all();
        }
        return view('admin.lembaga.anggota.create',compact('lembaga','penduduk'));
    }
    public function storeAnggota(Request $request, LembagaDesa $lembaga){
        $validate = $request->validate([
            'id_penduduk'=>'required',
            'jabatan'=>'required',
        ]);
        if($request->jabatan == 'KETUA'){
            $ketuaDulu = $lembaga->anggotaLembaga()->where('jabatan','KETUA')->first();
            if($ketuaDulu){
                $ketuaDulu->update(['jabatan'=>'ANGGOTA']);
            }
            $anggota = AnggotaLembaga::create([
                'id_lembaga'=>$lembaga->id,
                'id_penduduk'=>$request->id_penduduk,
                'foto'=>asset('img/profile-default.png'),
                'keterangan'=>$request->keterangan,
                'jabatan'=>'KETUA'
            ]);
            $lembaga->update(['id_ketua_lembaga'=>$request->id_penduduk]);
        }else{
            $anggota = AnggotaLembaga::create([
                'id_lembaga'=>$lembaga->id,
                'id_penduduk'=>$request->id_penduduk,
                'foto'=>asset('img/profile-default.png'),
                'keterangan'=>$request->keterangan,
                'jabatan'=>$request->jabatan
            ]);
        }
        if ($request->file('foto')) {
            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/lembaga/anggota', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $anggota->update(['foto'=>$url]);
        }
        return redirect()->route('admin.lembaga.show',$lembaga->id)->with('success','Berhasil Menambahkan Anggota Lembaga');
    }
}
