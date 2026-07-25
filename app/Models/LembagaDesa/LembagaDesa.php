<?php

namespace App\Models\LembagaDesa;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use App\Models\LembagaDesa\AnggotaLembaga;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa';

    protected $guarded = [];

    public function ketuaLembaga()
    {
        return $this->belongsTo(Penduduk::class,'id_ketua_lembaga');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function anggotaLembaga()
    {
        return $this->hasMany(AnggotaLembaga::class,'id_lembaga');
    }
}
