<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Database\Seeders\Penduduk\AgamaSeeder;
use Database\Seeders\Penduduk\CacatSeeder;
use Database\Seeders\Penduduk\GolonganDarahSeeder;
use Database\Seeders\Penduduk\HubunganSeeder;
use Database\Seeders\Penduduk\KondisiSeeder;
use Database\Seeders\Penduduk\PekerjaanSeeder;
use Database\Seeders\Penduduk\PendidikanKKSeeder;
use Database\Seeders\Penduduk\PendidikanSeeder;
use Database\Seeders\Penduduk\PendudukSeeder;
use Database\Seeders\Penduduk\PenyakitSeeder;
use Database\Seeders\Penduduk\StatusKawinSeeder;
use Database\Seeders\Penduduk\UmurSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AgamaSeeder::class);
        $this->call(DesaSeeder::class);
        $this->call(CacatSeeder::class);
        $this->call(GolonganDarahSeeder::class);
        $this->call(HubunganSeeder::class);
        $this->call(KondisiSeeder::class);
        $this->call(PekerjaanSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(PendidikanKKSeeder::class);
        $this->call(PenyakitSeeder::class);
        $this->call(UmurSeeder::class);
        $this->call(StatusKawinSeeder::class);
        $this->call(PendidikanKKSeeder::class);
        $this->call(PendidikanKKSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WilayahSeeder::class);
        // $this->call(PendudukSeeder::class);

    }

}
