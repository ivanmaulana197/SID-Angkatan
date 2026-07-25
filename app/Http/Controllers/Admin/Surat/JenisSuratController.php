<?php

namespace App\Http\Controllers\Admin\Surat;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Komponen\JenisDokumen;
use App\Models\Surat\JenisSurat;
use App\Models\Surat\SyaratSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = JenisSurat::all();
        return view('admin.jenis-surat.index',compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $syaratSurat = JenisDokumen::all();
        return view('admin.jenis-surat.create', compact('syaratSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validate = $request->validate([
            'nama'=>'required|unique:jenis_surat,nama',
        ]);

        $jenisSurat = JenisSurat::create([
            'nama'=>$request->nama
        ]);
        if($request->syarat){
            foreach ($request->syarat as $key => $value) {
                SyaratSurat::create([
                    'id_jenis_surat'=>$jenisSurat->id,
                    'id_jenis_dokumen'=>$value
                ]);
            }
        }

        return redirect(route('admin.surat.jenis-surat'))->with('success', 'Berhasil Menambahkan Jenis Surat');
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
    public function edit(JenisSurat $jenis)
    {
        $syaratSurat = JenisDokumen::all();
        return view('admin.jenis-surat.edit',compact('jenis','syaratSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisSurat $jenis)
    {
        $validate = $request->validate([
            'nama'=> 'required|unique:jenis_surat,nama,' . $jenis->id,
        ]);

        $jenis->update([
            'nama'=>$request->nama
        ]);
        if($request->syarat){
            $jenis->syaratSurat()->detach();
            foreach ($request->syarat as $key => $value) {
                SyaratSurat::create([
                    'id_jenis_surat'=>$jenis->id,
                    'id_jenis_dokumen'=>$value
                ]);
            }
        }else{
            $jenis->syaratSurat()->detach();
        }

        return redirect(route('admin.surat.jenis-surat'))->with('success', 'Berhasil Mengupdate Jenis Surat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisSurat $jenis)
    {
        $jenis->syaratSurat()->detach();
        $jenis->delete();
        return redirect(route('admin.surat.jenis-surat'))->with('success', 'Berhasil Menghapus Jenis Surat');
    }
}
