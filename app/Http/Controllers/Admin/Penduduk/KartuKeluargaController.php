<?php

namespace App\Http\Controllers\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Penduduk\PendudukKartuKeluarga;
use App\Models\Penduduk\PendudukUmur;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    
    public function index()
    {
        $kk = PendudukKartuKeluarga::all();
        return view('admin.keluarga.index',compact('kk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduk = Penduduk::where('id_hubungan','1')->where('id_kk',null)->get();
        return view('admin.keluarga.create', compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validate = $request->validate([
            'id_penduduk'=>'nullable|unique:penduduk_kartu_keluarga,id_penduduk,',
            'no_kk'=>'required|numeric|unique:penduduk_kartu_keluarga,no_kk'
         ],[
            'required'=>'Kolom ini Wajib diisi',
            'unique'=>'Data tersebut sudah ada'
         ]);
         $kk = PendudukKartuKeluarga::create([
            'no_kk'=>$request->no_kk,
            'id_penduduk'=>$request->id_penduduk
         ]);
         $penduduk = Penduduk::find($request->id_penduduk);
         if($penduduk){
             $penduduk->update(['id_kk'=>$kk->id]);
         }
         return redirect()->route('admin.keluarga')->with('success','Berhasil Menambahkan KK');

    }

    /**
     * Display the specified resource.
     */
    public function show(PendudukKartuKeluarga $kk)
    {
        return view('admin.keluarga.show',compact('kk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendudukKartuKeluarga $kk)
    {
        return view('admin.keluarga.edit', compact('kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendudukKartuKeluarga $kk)
    {
        $validate = $request->validate([
            'no_kk'=>'required|numeric|unique:penduduk_kartu_keluarga,no_kk,'.$kk->id
        ]);
        $kk->update(['no_kk'=>$request->no_kk]);
        return redirect()->route('admin.keluarga')->with('success','Berhasil Mengedit Kartu Keluarga');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendudukKartuKeluarga $kk)
    {
        $kk->delete();
        return redirect()->route('admin.keluarga')->with('success','Berhasil Menghapus Kartu Keluarga');
    }

    public function deletePenduduk(PendudukKartuKeluarga $kk, Penduduk $penduduk)
    {
        if($penduduk->id == $kk->id_penduduk){
            $kk->update([
                'id_penduduk'=>null,
            ]);
        }
        $penduduk->update([
            'id_kk'=>null
        ]);
        return redirect()->route('admin.keluarga.show',$kk->id)->with('success','Berhasil menghapus anggota keluarga');
    }

    public function pendudukCreate(PendudukKartuKeluarga $kk)
    {
        if($kk->id_penduduk){
            $penduduk = Penduduk::where('id_kk',null)->whereNot('id_hubungan','1')->get();
        }else{
            $penduduk = Penduduk::where('id_kk',null)->get();
        }

        return view('admin.keluarga.anggota.create',compact('kk','penduduk'));
    }

    public function pendudukStore(Request $request,PendudukKartuKeluarga $kk)
    {
        $penduduk = Penduduk::find($request->id_penduduk);
        
        if($penduduk->id_hubungan == 1){
            $kk->update(['id_penduduk'=>$penduduk->id]);
        }
        $penduduk->update([
            'id_kk'=>$kk->id
        ]);
        return redirect()->route('admin.keluarga.show',$kk->id)->with('success','Berhasil Menambahkan Anggota Keluarga');
    }
}
