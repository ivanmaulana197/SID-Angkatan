<?php

namespace App\Models\Penduduk;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukKartuKeluarga extends Model
{
    use HasFactory;
    protected $table = 'penduduk_kartu_keluarga';

    protected $guarded = [];

    public function kepalaKeluarga()
    {
        return $this->belongsTo(Penduduk::class,'id_penduduk');
    }

    //list penduduk
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_kk');
    }
}
