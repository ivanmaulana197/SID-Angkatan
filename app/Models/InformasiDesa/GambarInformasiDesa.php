<?php

namespace App\Models\InformasiDesa;

use Illuminate\Database\Eloquent\Model;
use App\Models\InformasiDesa\InformasiDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarInformasiDesa extends Model
{
    use HasFactory;
    protected $table= 'gambar_informasi_desa';
    protected $guarded= [];

    public function informasi_desa()
    {
        return $this->belongsTo(InformasiDesa::class,'id_informasi_desa');
    }
}
