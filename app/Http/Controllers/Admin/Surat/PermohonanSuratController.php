<?php

namespace App\Http\Controllers\Admin\Surat;

use App\Http\Controllers\Controller;
use App\Models\Surat\PermohonanSurat;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permohonanSurat = PermohonanSurat::all();
        return view('',compact('permohonanSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    
}
