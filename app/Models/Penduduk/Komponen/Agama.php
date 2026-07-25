<?php

namespace App\Models\Penduduk\Komponen;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $table = 'agama';
    public $timestamps = false;

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_agama');
    }
    
}
