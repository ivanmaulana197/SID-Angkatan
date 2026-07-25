<?php

namespace App\Http\Controllers\LayananMandiri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananMandiriController extends Controller
{

    public function profile()
    {
        $penduduk = auth('penduduk_layanan_mandiri')->user()->penduduk;
        return view('layanan-mandiri.profile.profile',compact('penduduk'));
    }

    public function gantiPIN()
    {
        $penduduk = auth('penduduk_layanan_mandiri')->user()->penduduk;
        return view('layanan-mandiri.profile.ganti-pin', compact('penduduk'));
    }

    public function updatePIN(Request $request)
    {
        $penduduk = $request->user('penduduk_layanan_mandiri');

        $request->validate(
            [
                'pin_lama' => 'required|numeric|digits:6',
                'pin_baru' => 'required|numeric|digits:6|different:pin_lama',
                'konfirmasi_pin_baru' => 'required|numeric|digits:6|same:pin_baru',
            ],
            [
                'digits'=>'PIN harus terdiri dari 6 digit.',
                'numeric'=>'PIN harus berupa angka.',
                'different'=>'PIN baru dan PIN lama harus berbeda',
                'same'=>'Konfirmasi PIN tidak cocok'
            ]
        );

        if ($penduduk->pin == $request->pin_lama) {
            $penduduk->update([
                'pin' => $request->pin_baru,
            ]);
            return redirect()
                ->route('layanan-mandiri')
                ->with('success', 'PIN Berhasil di Ubah.');
        } else {
            return redirect()
                ->back()
                ->withErrors(['pin_lama' => 'Password Lama Salah.'])
                ->withInput();
        }
    }
}
