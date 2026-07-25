<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\Desa;
use Illuminate\Http\Request;

class SIGController extends Controller
{
    public function lokasiDesa()
    {
        $data = Desa::find(1);
        $data = $data->lokasi_desa;
        return view('guest.sig.lokasi-desa',compact('data'));
    }
    public function lokasiKantorDesa()
    {
        $data = Desa::find(1);
        $data = $data->lokasi_kantor_desa;
        return view('guest.sig.lokasi-kantor-desa',compact('data'));
    }
}
