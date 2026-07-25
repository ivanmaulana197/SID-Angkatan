<?php

namespace App\Models\Surat;

use App\Models\Surat\TemplateKodeIsian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateKategoriKodeIsian extends Model
{
    use HasFactory;

    protected $table = 'template_kategori_kode_isian';

    function templateKodeIsian()
    {
        return $this->hasMany(TemplateKodeIsian::class,'id_template_kategori_kode_isian');
    }
}
