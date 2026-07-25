<?php

namespace App\Http\Controllers\Admin\Desa;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\SejarahDesa;
use Illuminate\Http\Request;

class SejarahDesaController extends Controller
{
    public function index()
    {
        $sejarahDesa = SejarahDesa::first();
        
        return view('admin.profile-desa.sejarah-desa.index',compact('sejarahDesa'));
    }

    public function store(Request $request)
    {
        $sejarahDesa = SejarahDesa::updateOrCreate(
            ['id' => '1'], // Kondisi pencarian berdasarkan kolom 'id'
            ['sejarah_desa'=>$request->sejarah_desa,'id_desa'=>'1'] // Data yang akan diperbarui atau digunakan untuk membuat entri baru
        );
        return redirect()->back()->with('success', 'Data Visi Misi berhasil disimpan atau diperbarui.');
    }
}
