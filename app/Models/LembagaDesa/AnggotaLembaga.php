<?php

namespace App\Models\LembagaDesa;

use App\Models\Penduduk;
use App\Models\LembagaDesa\LembagaDesa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggotaLembaga extends Model
{
    use HasFactory;

    protected $table = 'anggota_lembaga';

    protected $guarded = [];
    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class,'id_lembaga');
    }
    public function anggota()
    {
        return $this->belongsTo(Penduduk::class,'id_penduduk');
    }
}
