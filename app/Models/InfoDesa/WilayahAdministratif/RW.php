<?php

namespace App\Models\InfoDesa\WilayahAdministratif;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use App\Models\InfoDesa\WilayahAdministratif\RT;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rw';

    protected $guarded = [];

    public function ketuaRW()
    {
        return $this->belongsTo(Penduduk::class, 'id_ketua');
        
    }
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_rw');
    }

    public function dusun()
    {
        return $this->belongsTo(Dusun::class, 'id_dusun');
    }
    public function rt()
    {
        return $this->hasMany(RT::class, 'id_rw');
    }
}
