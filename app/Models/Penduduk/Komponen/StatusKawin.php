<?php

namespace App\Models\Penduduk\Komponen;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusKawin extends Model
{
    use HasFactory;
    protected $table = 'status_kawin';
    public $timestamps = false;
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class,'id_status_kawin');
    }
}
