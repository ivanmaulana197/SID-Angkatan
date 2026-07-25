<?php

namespace App\Models\Surat;

use App\Models\Surat\SyaratSurat;
use App\Models\Surat\PermohonanSurat;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk\Komponen\JenisDokumen;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';
    protected $guarded = [];

    public function syaratSurat()
    {
        return $this->belongsToMany(JenisDokumen::class, 'syarat_surat', 'id_jenis_surat', 'id_jenis_dokumen');
    }

    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class, 'id_jenis_surat');
    }
}
