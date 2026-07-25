<?php

namespace App\Models\Anggaran;

use App\Models\Anggaran\PivotAnggaran;
use App\Models\Anggaran\AnggaranKeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggaranMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'anggaran_masuk';
    public function anggaranPivot()
    {
        return $this->hasMany(PivotAnggaran::class, 'anggaran_masuk_id');
    }
    public function anggaranKeluar()
    {
        return $this->belongsToMany(AnggaranKeluar::class, 'pivot_anggarans', 'id_anggaran_masuk', 'id_anggaran_keluar')
            ->withPivot('jumlah_anggaran');
    }
}
