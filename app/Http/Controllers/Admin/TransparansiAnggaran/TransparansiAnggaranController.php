<?php

namespace App\Http\Controllers\Admin\TransparansiAnggaran;

use App\Http\Controllers\Controller;
use App\Models\Anggaran\AnggaranKeluar;
use App\Models\Anggaran\AnggaranMasuk;
use Illuminate\Http\Request;

class TransparansiAnggaranController extends Controller
{
    public function index()
    {
        $anggaranMasuk = AnggaranMasuk::all();
        $anggaranKeluar = AnggaranKeluar::all();
        // dd(count($anggaranMasuk[1]->anggaranKeluar));
        return view('admin.transparansi-anggaran.index',compact('anggaranMasuk','anggaranKeluar'));
    }
}
