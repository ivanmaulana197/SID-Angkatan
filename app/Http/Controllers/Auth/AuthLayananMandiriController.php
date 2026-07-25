<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLayananMandiriController extends Controller
{
    
    public function login()
    {
        return view('auth.layanan-mandiri');
    }

    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'nik'=>'required|numeric|digits:16',
            'pin'=>'required|numeric|digits:6'
        ],[
            'required'=>'Kolom ini wajib diisi',
            'numeric'=> 'Harus Terdiri dari Angka',
            'nik'=>[
                'digits'=>'NIK harus 16 digit'
            ],
            'pin'=>[
                'digits'=>'PIN terdiri dari 6 digit'
            ]
        ]);

        $credentials = $request->only('nik', 'pin');

        $penduduk = Penduduk::where('NIK',$credentials['nik'])->first();
        if($penduduk && $penduduk->layananMandiri && $penduduk->layananMandiri->pin == $credentials['pin']){
            
            Auth::guard('penduduk_layanan_mandiri')->login($penduduk->layananMandiri);
            return redirect()->intended(route('layanan-mandiri'));
        }else{
            return redirect()->back()->with('message','NIK atau PIN salah')
            ->withInput($request->except('password'));
        }


        
    }

    public function store(Request $request)
    {
        
    }
}
