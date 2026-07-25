<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $remember = $request->has('remember') ? true : false;

        if(Auth::attempt($credentials,$remember)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin'));
        }
        return redirect()->back()->with('message','username atau password salah')
                ->withInput($request->except('password'));
    }
    
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
