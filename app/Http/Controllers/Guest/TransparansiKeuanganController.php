<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Anggaran\AnggaranKeluar;
use App\Models\Anggaran\AnggaranMasuk;
use Illuminate\Http\Request;

class TransparansiKeuanganController extends Controller
{
    public function index()
    {
        $anggaranMasuk = AnggaranMasuk::all();
        $anggaranKeluar = AnggaranKeluar::all();
        return view('guest.transparansi-keuangan.index',compact('anggaranMasuk','anggaranKeluar'));
    }
}
