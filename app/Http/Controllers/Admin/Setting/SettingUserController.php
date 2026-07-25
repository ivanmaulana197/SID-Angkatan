<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SettingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('name',auth()->user()->name)->get();
        return view('admin.setting.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('guard_name','web')->get();
        return view('admin.setting.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|unique:users,name',
            'fullName'=>'required',
            'role' =>'required|array',
            'password'=>'required|min:8'
        ],[
            'fullName.required'=>'Nama Lengkap Harus Diisi',
            'name.required'=>'Username Harus Diisi',
            'name.unique'=>'Username Sudah Digunakan'
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        $user = User::create([
            'name'=>$request->name,
            'fullName'=>$request->fullName,
            'password'=>$validateData['password'],
            'foto'=> asset('img/profile-default.png'),
        ]);
        $user->assignRole($request->role);

        return redirect()->route('admin.setting.user')->with('success', 'Berhasil Menambahkan User');
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
    public function edit(User $user)
    {
        $roles = Role::where('guard_name','web')->get();
        // dd($user->roles());
        return view('admin.setting.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'name'=>'required|unique:users,name,'.$user->id,
            'fullName'=>'required',
            'role' =>'required|array',
        ],[
            'fullName.required'=>'Nama Lengkap Harus Diisi',
            'name.required'=>'Username Harus Diisi',
            'name.unique'=>'Username Sudah Digunakan'
        ]);
        
        $user->update([
            'name'=>$request->name,
            'fullName'=>$request->fullName,
        ]);

        $user->syncRoles($request->role);
        return redirect()->route('admin.setting.user')->with('success','Berhasil Mengedit User');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->berita()->delete();
        $user->informasiDesa()->delete();

        $user->delete();
        return redirect()->route('admin.setting.user')->with('success', 'Berhasil Menghapus User');
    }

    public function newPassword(User $user)
    {
        $user->update([
            'password'=>Hash::make('12345678')
        ]);
        return redirect()->route('admin.setting.user')->with('success', 'Akun <strong>'.$user->name.'</strong> Berhasil Update Password');
    }
}
