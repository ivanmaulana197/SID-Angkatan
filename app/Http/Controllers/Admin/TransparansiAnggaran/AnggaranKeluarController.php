<?php

namespace App\Http\Controllers\Admin\TransparansiAnggaran;

use App\Http\Controllers\Controller;
use App\Models\Anggaran\AnggaranKeluar;
use App\Models\Anggaran\AnggaranMasuk;
use App\Models\Anggaran\PivotAnggaran;
use Illuminate\Http\Request;

class AnggaranKeluarController extends Controller
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
        $anggaranMasuk = AnggaranMasuk::all();
        return view('admin.transparansi-anggaran.anggaran-keluar.create', compact('anggaranMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'nama' => 'required|unique:anggaran_keluar,nama',
            'inputs.*.dana' => 'required',
            'inputs.*.total' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|regex:/^\d{1,3}(,\d{3})*$/',
        ],[
            'required'=>'Kolom ini Wajib diisi'
        ]);
        $anggaran = [];
        
        foreach ($request->inputs as $i => $value) {
            $dana = $value['dana'];
            $total = $value['total'];

            // Mengecek apakah anggaran dengan dana yang sama sudah ada dalam $anggaranToAdd
            $existingAnggaranIndex = collect($anggaran)->search(function ($item) use ($dana) {
                return $item['dana'] === $dana;
            });
            if ($existingAnggaranIndex !== false) {
                // Jika anggaran dengan dana yang sama sudah ada, tambahkan total ke anggaran tersebut
                $anggaran[$existingAnggaranIndex]['total'] += $total;
            } else {
                // Jika anggaran dengan dana yang sama belum ada, tambahkan anggaran baru ke $anggaranToAdd
                $anggaran[] = [
                    'dana' => $dana,
                    'total' => $total,
                ];
            }
        }
        
        $anggaranKeluar = AnggaranKeluar::create([
            'nama'=>$request->nama,
            'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
            'total'=>str_replace(',', '', $request->jumlah),
            'keterangan'=>$request->keterangan
        ]);
        foreach($anggaran as $anggaran){
            
            $anggaranMasuk = AnggaranMasuk::find($anggaran['dana']);
            $anggaranMasuk->update([
                'sisa'=>$anggaranMasuk->sisa - str_replace(',', '', $anggaran['total'])
            ]);
            PivotAnggaran::create([
                'id_anggaran_masuk'=>$anggaran['dana'],
                'id_anggaran_keluar'=>$anggaranKeluar->id,
                'jumlah_anggaran'=>str_replace(',', '', $anggaran['total'])
            ]);
        }
        return redirect(route('admin.transparansi-anggaran'))->with('success','Berhasil Menambahkan Anggaran Keluar');
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
    public function edit(AnggaranKeluar $anggaran)
    {
        $anggaranMasuk = AnggaranMasuk::all();
        return view('admin.transparansi-anggaran.anggaran-keluar.edit',compact('anggaran','anggaranMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggaranKeluar $anggaran)
    {
        
        $validate = $request->validate([
            'nama' => 'required|unique:anggaran_keluar,nama,'.$anggaran->id,
            'inputs.*.dana' => 'required',
            'inputs.*.total' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|regex:/^\d{1,3}(,\d{3})*$/',
        ],[
            'required'=>'Kolom ini Wajib diisi'
        ]);
        $temp = [];
        
        foreach ($request->inputs as $i => $value) {
            $dana = $value['dana'];
            $total = $value['total'];

            // Mengecek apakah anggaran dengan dana yang sama sudah ada dalam $anggaranToAdd
            $existingAnggaranIndex = collect($temp)->search(function ($item) use ($dana) {
                return $item['dana'] === $dana;
            });
            if ($existingAnggaranIndex !== false) {
                // Jika anggaran dengan dana yang sama sudah ada, tambahkan total ke anggaran tersebut
                $temp[$existingAnggaranIndex]['total'] += $total;
            } else {
                // Jika anggaran dengan dana yang sama belum ada, tambahkan anggaran baru ke $anggaranToAdd
                $temp[] = [
                    'dana' => $dana,
                    'total' => $total,
                ];
            }
        }
        $anggaran->update([
            'nama'=>$request->nama,
            'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
            'total'=>str_replace(',', '', $request->jumlah),
            'keterangan'=>$request->keterangan
        ]);

        foreach ($anggaran->anggaranMasuk as $key => $value) {
            $value->update([
                'sisa'=>$value->sisa + $value->pivot->jumlah_anggaran
            ]);
        }
        $anggaran->anggaranMasuk()->detach();

        foreach($temp as $sumber){ 
            $anggaranMasuk = AnggaranMasuk::find($sumber['dana']);
            
            $anggaranMasuk->update([
                'sisa'=>$anggaranMasuk->sisa - str_replace(',', '', $sumber['total'])
            ]);
            PivotAnggaran::create([
                'id_anggaran_masuk'=>$sumber['dana'],
                'id_anggaran_keluar'=>$anggaran->id,
                'jumlah_anggaran'=>str_replace(',', '', $sumber['total'])
            ]);
        }
        return redirect(route('admin.transparansi-anggaran'))->with('success','Berhasil Mengedit Anggaran Keluar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggaranKeluar $anggaran)
    {
        foreach ($anggaran->anggaranMasuk as $key => $value) {
            $value->update([
                'sisa'=>$value->sisa + $value->pivot->jumlah_anggaran
            ]);
        }
        $anggaran->anggaranMasuk()->detach();
        $anggaran->delete();
        return redirect(route('admin.transparansi-anggaran'))->with('success','Berhasil Menghapus Anggaran Keluar');
    }
}
