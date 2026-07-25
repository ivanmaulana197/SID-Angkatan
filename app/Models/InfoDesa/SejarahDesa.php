<?php

namespace App\Models\InfoDesa;

use App\Models\InfoDesa\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SejarahDesa extends Model
{
    use HasFactory;
    protected $table = 'sejarah_desa';
    protected $guarded = [];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
