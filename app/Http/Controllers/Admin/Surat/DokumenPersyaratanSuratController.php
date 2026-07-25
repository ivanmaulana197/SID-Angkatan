<?php

namespace App\Http\Controllers\Admin\Surat;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Komponen\JenisDokumen;
use Illuminate\Http\Request;

class DokumenPersyaratanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumen = JenisDokumen::all();
        return view('admin.persyaratan-surat.index', compact('dokumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.persyaratan-surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=>'required'
        ]);

        JenisDokumen::create($validate);

        return redirect(route('admin.surat.persyaratan-surat'))->with('success','Berhasil Menambahkan Jenis Dokumen Persyaratan Surat');
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
    public function edit(JenisDokumen $jenis)
    {
            
        return view('admin.persyaratan-surat.edit',compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisDokumen $jenis)
    {
        $validate = $request->validate([
            'nama'=>'required'
        ]);
        $jenis->update($validate);

        return redirect(route('admin.surat.persyaratan-surat'))->with('success','Berhasil Mengubah Jenis Dokumen Persyaratan Surat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisDokumen $jenis)
    {
        
        $jenis->jenisSurat()->detach();
        $jenis->dokumen()->delete();
        $jenis->delete();

        return redirect(route('admin.surat.persyaratan-surat'))->with('success','Berhasil MenGhapus Jenis Dokumen Persyaratan Surat');
    }
}
