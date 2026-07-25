<?php

namespace App\Http\Controllers\Admin\LayananMandiri;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Penduduk\PendudukLayananMandiri;
use Illuminate\Http\Request;

class LayananMandiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendudukLayananMandiri = PendudukLayananMandiri::all();
        return view('admin.layanan-mandiri.index',compact('pendudukLayananMandiri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduk = Penduduk::whereDoesntHave('layananMandiri')->get();
        
        return view('admin.layanan-mandiri.create',compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_penduduk'=>'required'
        ],[
            'required'=>'Kolom ini tidak boleh kosong'
        ]);
        $pin = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $penduduk =PendudukLayananMandiri::create([
            'id_penduduk'=>$validate['id_penduduk'],
            'pin'=>$pin
        ]);

        return redirect()->route('admin.layanan-mandiri')->with(['success'=>'Berhasil Mendaftarkan Penduduk','newMember'=>$penduduk->penduduk->nama, 'PIN'=>$pin]);
        // PendudukLayananMandiri::create([
        //     'pin'=> 
        // ])
    }

    public function gantiPin(PendudukLayananMandiri $penduduk)
    {
        $pin = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $penduduk->update([
            'pin'=>$pin
        ]);

        return redirect(route('admin.layanan-mandiri'))->with(['success'=>'Berhasil Mereset PIN','penduduk'=>$penduduk->penduduk->nama,'PIN baru'=>$pin]);
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
    public function destroy(PendudukLayananMandiri $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('admin.layanan-mandiri')->with('success','Berhasil menghapus penduduk dari layanan mandiri');
    }
}
