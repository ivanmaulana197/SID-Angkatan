<?php

namespace App\Models\InfoDesa\WilayahAdministratif;

use App\Models\Penduduk;
use App\Models\InfoDesa\Desa;
use Illuminate\Database\Eloquent\Model;
use App\Models\InfoDesa\WilayahAdministratif\RW;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dusun extends Model
{
    use HasFactory;

    protected $table = 'dusun';

    protected $guarded = [];
    // public function desa()
    // {
    //     return $this->belongsTo(Desa::class, 'id_desa');
    // }
    public function kepalaDusun()
    {
        return $this->belongsTo(Penduduk::class, 'id_kepala');
    }
    public function rw()
    {
        return $this->hasMany(RW::class, 'id_dusun');
    }
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_dusun');
    }
    
}
