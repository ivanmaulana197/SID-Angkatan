<?php

namespace App\Models\Berita;

use App\Models\Berita\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBerita extends Model
{
    use HasFactory;
    protected $table= 'kategori_berita';

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function berita()
    {
        return $this->hasMany(Berita::class,'id_kategori');
    }
}
