<?php

namespace App\Models\Penduduk\Komponen;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendidikanKK extends Model
{
    use HasFactory;
    protected $table = 'pendidikan_kk';
    public $timestamps = false;
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_pendidikan_kk');
    }
}
