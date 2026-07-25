<?php

namespace App\Models\Penduduk\Komponen;

use App\Models\Penduduk;
use App\Models\Surat\JenisSurat;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk\PendudukDokumen;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisDokumen extends Model
{
    use HasFactory;
    protected $table = 'jenis_dokumen';
    public $timestamps = false;

    protected $guarded = [];

    public function jenisSurat()
    {
        return $this->belongsToMany(JenisSurat::class, 'syarat_surat', 'id_jenis_dokumen','id_jenis_surat');
    }

    public function dokumen()
    {
        return $this->hasMany(PendudukDokumen::class,'id_jenis_dokumen');
    }
    
}
