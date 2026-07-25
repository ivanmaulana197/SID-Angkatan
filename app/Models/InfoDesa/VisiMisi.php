<?php

namespace App\Models\InfoDesa;

use App\Models\InfoDesa\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisiMisi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'visi_misi';

    public function desa()
    {
        return $this->belongsTo(Desa::class ,'id_desa');
    }
}
