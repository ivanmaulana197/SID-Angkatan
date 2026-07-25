<?php

namespace App\Models\Surat;

use App\Models\Penduduk;
use App\Models\Surat\JenisSurat;
use App\Models\Surat\KirimSurat;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk\PendudukDokumen;
use App\Models\Surat\PermohonanSuratAksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermohonanSurat extends Model
{
    use HasFactory;
    protected $table = 'permohonan_surat';
    protected $guarded = [];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class,'id_jenis_surat');
    }

    public function kirimSurat()
    {
        return $this->hasOne(KirimSurat::class,'id_permohonan_surat');
    }

    public function dokumenPenduduk()
    {
        return $this->belongsToMany(PendudukDokumen::class, 'permohonan_surat_dokumen', 'id_permohonan_surat', 'id_dokumen_penduduk');
    }

    public function permohonanSuratAksi()
    {
        return $this->hasOne(PermohonanSuratAksi::class,'id_permohonan');
    }
}
