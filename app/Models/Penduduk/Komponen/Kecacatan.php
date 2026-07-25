<?php

namespace App\Models\Penduduk\Komponen;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecacatan extends Model
{
    use HasFactory;
    protected $table = 'kecacatan';
    public $timestamps = false;
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_cacat');
    }
}
