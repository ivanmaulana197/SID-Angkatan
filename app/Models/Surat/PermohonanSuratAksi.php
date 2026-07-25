<?php

namespace App\Models\Surat;

use App\Models\Surat\PermohonanSurat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermohonanSuratAksi extends Model
{
    use HasFactory;

    protected $table = "permohonan_surat_aksi";
    protected $guarded = [];

    public function permohonanSurat()
    {
        return $this->belongsTo(PermohonanSurat::class,'id_permohonan');
    }
}
