<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::latest()
        ->paginate(6);
        return view('guest.agenda.index',compact('agenda'));
    }

    public function show(Agenda $agenda)
    {
        return view('guest.agenda.show',compact('agenda'));
    }
}
