<?php

namespace App\Models\Anggaran;

use App\Models\Anggaran\AnggaranMasuk;
use App\Models\Anggaran\PivotAnggaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggaranKeluar extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'anggaran_keluar';
    public function anggaranPivot()
    {
        return $this->hasMany(PivotAnggaran::class, 'anggaran_keluar_id');
    }
    public function anggaranMasuk()
    {
        return $this->belongsToMany(AnggaranMasuk::class, 'pivot_anggarans', 'id_anggaran_keluar', 'id_anggaran_masuk')
            ->withPivot('jumlah_anggaran');
    }   
}
