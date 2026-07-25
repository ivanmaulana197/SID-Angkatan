<?php

namespace App\Models\InformasiDesa;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\InformasiDesa\GambarInformasiDesa;
use App\Models\InformasiDesa\KategoriInformasiDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformasiDesa extends Model
{
    use HasFactory;
    protected $table= 'informasi_desa';
    public $enumFields = [
        'status' => ['PUBLISHED', 'DRAFT', 'ARCHIVED']
    ];
    protected $guarded = [];

    

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriInformasiDesa::class, 'id_kategori');
    }

    public function images()
    {
        return $this->hasMany(GambarInformasiDesa::class,'id_informasi_desa');
    }
}
