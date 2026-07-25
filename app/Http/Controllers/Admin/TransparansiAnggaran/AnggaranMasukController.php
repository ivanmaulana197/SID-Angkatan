<?php

namespace App\Http\Controllers\Admin\TransparansiAnggaran;

use App\Http\Controllers\Controller;
use App\Models\Anggaran\AnggaranMasuk;
use Illuminate\Http\Request;

class AnggaranMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transparansi-anggaran.anggaran-masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=>'required|unique:anggaran_masuk,nama',
            'tanggal'=>'required|date',
            'total'=>'required|regex:/^\d{1,3}(,\d{3})*$/',
        ],[
            'required'=>'Kolom ini harus diisi'
        ]);
        $anggaran = AnggaranMasuk::create([
            'nama'=>$request->nama,
            'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
            'total'=>str_replace(',', '', $request->total),
            'sisa'=>str_replace(',', '', $request->total),
            'keterangan'=>$request->keterangan
        ]);

        return redirect(route('admin.transparansi-anggaran'))->with('success','Berhasil Menambahkan Anggaran Masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggaranMasuk $anggaran)
    {
        // return view('admin.transparansi-anggaran.anggaran-masuk.edit',compact('anggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggaranMasuk $anggaran)
    {
        return view('admin.transparansi-anggaran.anggaran-masuk.edit',compact('anggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggaranMasuk $anggaran)
    {
        $validate = $request->validate([
            'nama'=>'required|unique:anggaran_masuk,nama,'.$anggaran->id,
            'tanggal'=>'required|date',
            'total'=>'required|regex:/^\d{1,3}(,\d{3})*$/',
        ],[
            'required'=>'Kolom ini harus diisi'
        ]);   
        $jmlSebelumnya = $anggaran->total;
        $selisih = str_replace(',', '', $request->total) - $jmlSebelumnya;
        $sisa = $anggaran->sisa + $selisih;
        $anggaran->update([
            'nama'=>$request->nama,
            'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
            'total' =>str_replace(',', '', $request->total),
            'sisa'=>$sisa
        ]);
        return redirect(route('admin.transparansi-anggaran'))->with('success','Berhasil Mengupdate Anggaran Masuk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggaranMasuk $anggaran)
    {
        $anggaran->delete();
        return redirect(route('admin.transparansi-anggaran'))->with('success','Berhasil Menghapus Anggaran Masuk');
    }
}
