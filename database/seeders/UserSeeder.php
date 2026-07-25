<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'fullName'=>'Admin Desa',
            'name'=>'admin',
            'password'=>bcrypt('12345678'),
            'foto'=>asset('img/profile-default.png')
        ]);
        $operator = User::create([
            'fullName'=>'Admin Desa',
            'name'=>'operator',
            'password'=>bcrypt('12345678'),
            'foto'=>asset('img/profile-default.png')
        ]);
        
        $operator->assignRole('admin');
        $admin->assignRole('admin');
        $admin = User::create([
            'fullName'=>'User Desa',
            'name'=>'user',
            'password'=>bcrypt('12345678'),
            'foto'=>asset('img/profile-default.png')
        ]);
        $admin->assignRole('aparatur desa');
        // $operator->assignRole('admin');
    }
}
