<?php

namespace App\Models\Penduduk;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendudukHubungan extends Model
{
    use HasFactory;
    protected $table = 'penduduk_hubungan';
    public $timestamps = false;

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_hubungan');
    }
}
