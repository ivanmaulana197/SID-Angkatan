<?php

namespace App\Models\InformasiDesa;

use Illuminate\Database\Eloquent\Model;
use App\Models\InformasiDesa\InformasiDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriInformasiDesa extends Model
{
    use HasFactory;
    protected $table= 'kategori_informasi_desa';

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function informasi_desa()
    {
        return $this->hasMany(InformasiDesa::class,'id_kategori');
    }
}
