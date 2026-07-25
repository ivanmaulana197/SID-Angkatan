<?php

namespace App\Models\InfoDesa;

use App\Models\InfoDesa\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemerintahDesa extends Model
{
    use HasFactory;
    protected $table = 'pemerintah_desa';

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
