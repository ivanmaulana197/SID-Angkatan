<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\InfoDesa\PemerintahDesa;
use App\Models\InfoDesa\SejarahDesa;
use App\Models\InfoDesa\VisiMisi;
use Illuminate\Http\Request;

class ProfileDesaController extends Controller
{
    public function visiMisi()
    {
        $visiMisi = VisiMisi::find(1);
        return view('guest.profile-desa.visi-misi',compact('visiMisi'));
    }
    public function pemerintahDesa()
    {
        $pemerintahDesa = PemerintahDesa::find(1);
        return view('guest.profile-desa.pemerintah-desa',compact('pemerintahDesa'));
    }
    public function sejarahDesa()
    {
        $sejarahDesa = SejarahDesa::find(1);
        return view('guest.profile-desa.sejarah-desa',compact('sejarahDesa'));
    }
}
