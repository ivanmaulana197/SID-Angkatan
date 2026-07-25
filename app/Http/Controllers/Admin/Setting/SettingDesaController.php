<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InfoDesa\Desa;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Storage;

class SettingDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $desa = Desa::find(1);
        
        $penduduk = Penduduk::all();
        return view('admin.setting.desa.index',compact('desa','penduduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'kode'=>'nullable',
            'kecamatan'=>'required',
            'kabupaten'=>'required',
            'provinsi'=>'required',
            'alamat'=>'required',
            'logo'=>'nullable',
            'id_kepala_desa'=>'required'
        ]);
        $desa = Desa::find(1);
        if ($request->file('logo')) {
            //hapus dulu
            $pathFoto = str_replace(url('/storage'), '', $desa->logo);
            Storage::delete($pathFoto);

            $nama_file = Str::uuid() . '.' . $request->logo->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/logo', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $desa->update(['logo' => $url]);
        }
        $desa->update([
            'nama'=>$request->nama,
            'kode'=>$request->kode,
            'kecamatan'=>$request->kecamatan,
            'provinsi'=>$request->provinsi,
            'alamat'=>$request->alamat,
            'id_kepala_desa'=>$request->id_kepala_desa,
            'lokasi_desa'=>$request->lokasi_desa,
            'lokasi_kantor_desa'=>$request->lokasi_kantor_desa
        ]);

        return redirect(route('admin.setting.desa'))->with('success', 'Berhasil Mengupdate Data Desa');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
