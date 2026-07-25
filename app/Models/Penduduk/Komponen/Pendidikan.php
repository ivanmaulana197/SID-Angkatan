<?php

namespace App\Models\Penduduk\Komponen;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikan';
    public $timestamps = false;
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_sedang_pendidikan');
    }
}
