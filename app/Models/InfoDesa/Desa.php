<?php

namespace App\Models\InfoDesa;

use App\Models\Penduduk;
use App\Models\InfoDesa\VisiMisi;
use App\Models\InfoDesa\SejarahDesa;
use Illuminate\Database\Eloquent\Model;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $guarded = [];
    public function visiMisi()
    {
        return $this->hasOne(VisiMisi::class);
    }
    public function sejarahDesa()
    {
        return $this->hasOne(SejarahDesa::class);
    }

    public function kepala()
    {
        return $this->belongsTo(Penduduk::class,'id_kepala_desa');
    }
    // public function dusun()
    // {
    //     return $this->hasMany(Dusun::class, 'id_desa');
    // }
}
