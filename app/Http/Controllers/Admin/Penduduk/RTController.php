<?php

namespace App\Http\Controllers\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\InfoDesa\WilayahAdministratif\RT;
use App\Models\InfoDesa\WilayahAdministratif\RW;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class RTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dusun $dusun, RW $rw)
    {
        $rt = $rw->rt;
        return view('admin.wilayah-administratif.rt.index', compact('dusun','rw','rt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Dusun $dusun, RW $rw)
    {
        $penduduk = Penduduk::all();
        // $penduduk = Penduduk::doesntHave('ketuaRT')->get(); jika ketua RT tidak boleh rangkap jabatan
        return view('admin.wilayah-administratif.rt.create', compact('dusun','rw','penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Dusun $dusun, RW $rw)
    {
        $validated = $request->validate([
            
            'rt' =>'required|numeric|unique:rt,rt,NULL,id,id_rw,'.$rw->id,
            
        ]);
        RT::create([
            'rt'=>$request->rt,
            'id_rw'=>$rw->id,
            'id_ketua'=>$request->id_ketua ?? null
        ]);
        return redirect()->route('admin.rt', [$dusun->id,$rw->id])->with('success','Berhasil Menambahkan RT');
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
    public function edit(Dusun $dusun, RW $rw, RT $rt)
    {
        if ($rt->ketuaRT) {
            $penduduk = Penduduk::whereNot('id', $rt->ketuaRT->id)->get();
        } else {
            $penduduk = Penduduk::all();
        }
        return view('admin.wilayah-administratif.rt.edit', compact('dusun','rw','rt','penduduk'));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dusun $dusun, RW $rw, RT $rt)
    {
        $validated = $request->validate([
            'rt' =>'required|numeric|unique:rt,rt,'.$rt->id.',id,id_rw,'.$rw->id,
        ]);
        if($request->id_ketua){
            $rt->update([
                'id_ketua'=>$request->id_ketua,
            ]);
        }
        $rt->update([
            'rt'=>$request->rt,
            'id_rw'=>$rw->id,
        ]);
        return redirect()->route('admin.rt', [$dusun->id,$rw->id])->with('success','Berhasil Mengedit RT');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dusun $dusun, RW $rw, RT $rt)
    {        
        $rt->delete();
        return redirect()->route('admin.rt',[$dusun->id, $rw->id])->with('success','Berhasil Menghapus RW dari Dusun: '.$dusun->nama);
    }
}
