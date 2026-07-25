<?php

namespace App\Models\Penduduk;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk\Komponen\JenisDokumen;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendudukDokumen extends Model
{
    use HasFactory;
    protected $table = 'penduduk_dokumen';

    protected $guarded = [];
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class,'id_penduduk');
    }

    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class,'id_jenis_dokumen');
    }
}
