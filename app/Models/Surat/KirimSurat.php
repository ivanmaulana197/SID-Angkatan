<?php

namespace App\Models\Surat;

use App\Models\User;
use App\Models\Surat\PermohonanSurat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KirimSurat extends Model
{
    use HasFactory;
    protected $table = 'kirim_surat';
    protected $guarded = [];

    public function perangkatDesa()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function permohonanSurat()
    {
        return $this->belongsTo(PermohonanSurat::class,'id_permohonan_surat');
    }

}
