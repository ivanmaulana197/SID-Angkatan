<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\LembagaDesa\LembagaDesa;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    public function all()
    {
        $lembaga = LembagaDesa::orderBy('nama','asc')->paginate(6);
        return view('guest.lembaga.lembaga-all',compact('lembaga'));
    }

    public function show(LembagaDesa $lembaga)
    {
        return view('guest.lembaga.show',compact('lembaga'));
    }
}
