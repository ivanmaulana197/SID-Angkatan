<?php

namespace App\Models\Berita;

use App\Models\Berita\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarBerita extends Model
{
    use HasFactory;
    protected $table= 'gambar_berita';
    protected $guarded= [];

    public function berita()
    {
        return $this->belongsTo(Berita::class,'id_berita');
    }
}
