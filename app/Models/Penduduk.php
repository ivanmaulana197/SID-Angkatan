<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use App\Models\LembagaDesa\LembagaDesa;
use App\Models\Penduduk\Komponen\Agama;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk\PendudukKondisi;
use App\Models\Penduduk\PendudukHubungan;
use App\Models\Penduduk\Komponen\Penyakit;
use App\Models\Penduduk\Komponen\Kecacatan;
use App\Models\Penduduk\Komponen\Pekerjaan;
use App\Models\Penduduk\Komponen\StatusKawin;
use App\Models\Penduduk\PendudukKartuKeluarga;
use App\Models\Penduduk\Komponen\GolonganDarah;
use App\Models\InfoDesa\WilayahAdministratif\RT;
use App\Models\InfoDesa\WilayahAdministratif\RW;
use App\Models\InfoDesa\WilayahAdministratif\Dusun;
use App\Models\LembagaDesa\AnggotaLembaga;
use App\Models\Penduduk\PendudukDokumen;
use App\Models\Penduduk\PendudukLayananMandiri;
use App\Models\Penduduk\PendudukUmur;
use App\Models\Surat\KirimSurat;
use App\Models\Surat\PermohonanSurat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;

class Penduduk extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'penduduk';

    protected $guarded = [];

    
    public function dokumen()
    {
        return $this->hasMany(PendudukDokumen::class,'id_penduduk');
    }

    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class,'id_penduduk');
    }

    public function layananMandiri()
    {
        return $this->hasOne(PendudukLayananMandiri::class,'id_penduduk');
    }
    public function kepalaDusun()
    {
        return $this->hasOne(Dusun::class,'id_kepala');
    }
    public function ketuaRW()
    {
        return $this->hasOne(RW::class,'id_ketua');
    }
    public function ketuaRT()
    {
        return $this->hasOne(RT::class,'id_ketua');
    }
    public function ketuaLembaga()
    {
        return $this->hasOne(LembagaDesa::class,'id_ketua_lembaga');
    }
    public function anggotaLembaga()
    {
        return $this->hasOne(AnggotaLembaga::class,'id_penduduk');
    }
    public function dusun()
    {
        return $this->belongsTo(Dusun::class, 'id_dusun');
    }
    public function rw()
    {
        return $this->belongsTo(RW::class, 'id_rw');
    }
    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class,'id_pekerjaan');
    }
    

    public function isKepalaDusun()
    {
        return $this->dusun && $this->id == $this->dusun->id_kepala;
    }
    public function no_kk()
    {
        return $this->belongsTo(PendudukKartuKeluarga::class,'id_kk');
    }

    public function kondisi()
    {
        return $this->belongsTo(PendudukKondisi::class,'id_kondisi');
    }
    
    public function hubungan()
    {
        return $this->belongsTo(PendudukHubungan::class,'id_hubungan');
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class,'id_agama');
    }
    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class,'id_golongan_darah');
    }
    public function kecacatan()
    {
        return $this->belongsTo(Kecacatan::class,'id_cacat');
    }
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class,'id_penyakit');
    }
    public function statusKawin()
    {
        return $this->belongsTo(StatusKawin::class,'id_status_kawin');
    }
    public function rentangUsia()
    {
        return $this->belongsTo(PendudukUmur::class,'id_usia');
    }
}
