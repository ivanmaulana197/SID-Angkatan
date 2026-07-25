<?php

namespace App\Models\Berita;

use App\Models\User;
use App\Models\Berita\GambarBerita;
use App\Models\Berita\KategoriBerita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    protected $table= 'berita';
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
        return $this->belongsTo(KategoriBerita::class, 'id_kategori');
    }

    public function images()
    {
        return $this->hasMany(GambarBerita::class,'id_berita');
    }
}
