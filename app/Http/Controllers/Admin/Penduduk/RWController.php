<?php

namespace App\Http\Controllers\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\InfoDesa\WilayahAdministratif\RW;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class RWController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dusun $dusun)
    {
        $rw = $dusun->rw;
        return view('admin.wilayah-administratif.rw.index', compact('rw','dusun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Dusun $dusun)
    {
        $penduduk = Penduduk::all();
        return view('admin.wilayah-administratif.rw.create', compact('dusun','penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Dusun $dusun, Request $request)
    {
        $validated = $request->validate([
            'rw' =>'required|numeric|unique:rw,rw,NULL,id,id_dusun,'.$dusun->id,
        ]);

        RW::create([
            'rw'=>$request->rw,
            'id_dusun'=>$dusun->id,
            'id_ketua'=>$request->id_ketua ?? null
        ]);
        return redirect()->route('admin.rw', $dusun->id)->with('success','Berhasil Menambahkan RW');
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
    public function edit(Dusun $dusun, RW $rw)
    {
        
        if ($rw->ketuaRW) {
            $penduduk = Penduduk::whereNot('id', $rw->ketuaRW->id)->get();
        } else {
            $penduduk = Penduduk::all();
        }
        return view('admin.wilayah-administratif.rw.edit', compact('dusun','rw','penduduk'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dusun $dusun, RW $rw)
    {
        $validated = $request->validate([
            'rw' =>'required|numeric|unique:rw,rw,'.$rw->id.',id,id_dusun,'.$dusun->id,
        ]);
        if($request->id_ketua){
            $rw->update([
                'id_ketua'=>$request->id_ketua,
            ]);
        }
        $rw->update([
            'rw'=>$request->rw,
            'id_dusun'=>$dusun->id,
        ]);
        return redirect()->route('admin.rw', $dusun->id)->with('success','Berhasil Mengedit RW');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dusun $dusun, RW $rw)
    {
        $rw->rt()->delete();
        $rw->delete();
        return redirect()->route('admin.rw',$dusun->id)->with('success','Berhasil Menghapus RW dari Dusun: '.$dusun->nama);

    }
}
