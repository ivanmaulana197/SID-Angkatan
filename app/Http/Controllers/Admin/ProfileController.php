<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        return view('admin.profile.index',compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        // dd($request->all());
        $validate = $request->validate([
            'name'=>'required|unique:users,name,'.$user->id,
            'fullName'=>'required',
            'foto'=>'image|mimes:png,jpg,jpeg'
        ]);

        if($request->file('foto')){
            $pathFoto = str_replace(url('/storage'), '', $user->foto);
            Storage::delete($pathFoto);

            $nama_file = Str::uuid() . '.' . $request->foto->getClientOriginalExtension();
            $path = $request->foto->storeAs('images/user', $nama_file);
            // Buat symlink dari folder storage/app/public ke public/storage
            $url = Storage::url($path);
            $user->update(['foto'=>$url]);
        }
        if($request->has('default_image')){
            $pathFoto = str_replace(url('/storage'), '', $user->foto);
            Storage::delete($pathFoto);

            $user->update(['foto'=>asset('img/profile-default.png')]);
        }
        $user->update([
            'name'=>$request->name,
            'fullName'=>$request->fullName
        ]);

        return redirect(route('admin.profile'))->with('success','Berhasil Mengupdate Profile');
    }

    public function ubahPassword()
    {
        $user = auth()->user();
        return view('admin.profile.ubah-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password'
        ]);
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password'=>Hash::make($request->new_password)
            ]);

            return redirect()->route('admin.profile')->with('success', 'Password Berhasil di Ubah.');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Password Lama Salah.'])->withInput();
        }
    }
}
