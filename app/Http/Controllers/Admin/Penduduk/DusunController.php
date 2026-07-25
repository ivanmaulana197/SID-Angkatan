<?php

namespace App\Http\Controllers\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dusun = Dusun::all();
        // foreach ($dusuns as $dusun) {
        //     $penduduk = Penduduk::where('id_dusun',$dusun->id)->count();
        //     $dusuns['jumlah_penduduk']=$penduduk;
        // }
        // dd($dusuns);
        // $penduduk = Penduduk::where('id_dusun',$dusun);
        return view('admin.wilayah-administratif.index', compact('dusun'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduk = Penduduk::doesntHave('kepalaDusun')->get();
        return view('admin.wilayah-administratif.create', compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' =>'required',            
        ]);

        Dusun::create([
            'nama'=>$request->nama,
            'id_kepala'=>$request->id_kepala??null
        ]);
        return redirect()->route('admin.dusun')->with('success','Berhasil Menambahkan Dusun');
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
    public function edit(Dusun $dusun)
    {
        if ($dusun->kepalaDusun) {
            $penduduk = Penduduk::whereNot('id', $dusun->kepalaDusun->id)->get();
        } else {
            $penduduk = Penduduk::all();
        }
        
        return view('admin.wilayah-administratif.edit', compact('dusun','penduduk'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dusun $dusun)
    {
        $validated = $request->validate([
            'nama' =>'required',
            
        ]);
        // dd($request->id_kepala);
        if($request->id_kepala){
            $dusun->update([
                'id_kepala'=>$request->id_kepala,
            ]);
        }
        $dusun->update([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('admin.dusun')->with('success','Berhasil Mengedit Dusun');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dusun $dusun)
    {
        $rw = $dusun->rw;
        foreach ($rw as $rw ) {
            $rw->rt()->delete();
        }
        $dusun->rw()->delete();
        $dusun->delete();
        return redirect()->route('admin.dusun')->with('success','Berhasil Menghapus Dusun');
    }
}
