<?php

namespace App\Models\Penduduk;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendudukKondisi extends Model
{
    use HasFactory;
    protected $table = 'penduduk_kondisi';
    public $timestamps = false;
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_kondisi');
    }
}
