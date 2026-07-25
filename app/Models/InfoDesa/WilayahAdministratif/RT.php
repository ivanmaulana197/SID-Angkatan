<?php

namespace App\Models\InfoDesa\WilayahAdministratif;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use App\Models\InfoDesa\WilayahAdministratif\RW;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $guarded = [];
    public function ketuaRT()
    {
        return $this->belongsTo(Penduduk::class, 'id_ketua');
    }

    public function rw()
    {
        return $this->belongsTo(RW::class,'id_rw');
    }

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_rt');
    }
}
