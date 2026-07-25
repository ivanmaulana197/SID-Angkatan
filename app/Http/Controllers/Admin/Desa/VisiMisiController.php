<?php

namespace App\Http\Controllers\Admin\Desa;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        
        return view('admin.profile-desa.visi-misi.index',compact('visiMisi'));
    }

    public function store(Request $request)
    {
        $visiMisi = VisiMisi::updateOrCreate(
            ['id' => '1'], // Kondisi pencarian berdasarkan kolom 'id'
            ['visi_misi'=>$request->visi_misi,'id_desa'=>'1'] // Data yang akan diperbarui atau digunakan untuk membuat entri baru
        );
        return redirect()->back()->with('success', 'Data Visi Misi berhasil disimpan atau diperbarui.');
    }
}
