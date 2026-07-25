<?php

namespace App\Models\Anggaran;

use App\Models\Anggaran\AnggaranMasuk;
use App\Models\Anggaran\AnggaranKeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PivotAnggaran extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pivot_anggarans';
    public function anggaranMasuk()
    {
        return $this->belongsTo(AnggaranMasuk::class, 'anggaran_masuk_id');
    }

    public function anggaranKeluar()
    {
        return $this->belongsTo(AnggaranKeluar::class, 'anggaran_keluar_id');
    }
}
