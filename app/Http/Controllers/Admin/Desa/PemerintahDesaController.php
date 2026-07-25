<?php

namespace App\Http\Controllers\Admin\Desa;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\PemerintahDesa;
use Illuminate\Http\Request;

class PemerintahDesaController extends Controller
{
    public function index()
    {
        $pemerintahDesa = PemerintahDesa::first();
        
        return view('admin.profile-desa.pemerintah-desa.index',compact('pemerintahDesa'));
    }

    public function store(Request $request)
    {
        $visiMisi = PemerintahDesa::updateOrCreate(
            ['id' => '1'], // Kondisi pencarian berdasarkan kolom 'id'
            ['pemerintah_desa'=>$request->pemerintah_desa,'id_desa'=>'1'] // Data yang akan diperbarui atau digunakan untuk membuat entri baru
        );
        return redirect()->back()->with('success', 'Data Visi Misi berhasil disimpan atau diperbarui.');
    }
}
