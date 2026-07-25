<?php

namespace App\Http\Controllers\Admin\Agenda;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use DateTime;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenda = Agenda::latest()->get();
        return view('admin.agenda.index',compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'nama'=>'required',
            'tanggal_agenda'=>'required|date_format:d/m/y H:i',
            'keterangan'=>'required'
        ]);
        // $timestamp = strtotime($request->tanggal_agenda);
        $date = DateTime::createFromFormat('d/m/y H:i', $request->tanggal_agenda);
        $formattedDate = $date->format('Y-m-d H:i:s');
        // dd($formattedDate);
        Agenda::create([
            'nama'=>$request->nama,
            'tanggal_agenda'=>$formattedDate,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect(route('admin.agenda'))->with('success','Berhasil Menambahkan Agenda');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        return view('admin.agenda.show',compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit',compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'tanggal_agenda'=>'required|date_format:d/m/y H:i',
            'keterangan'=>'required'
        ]);
        // $timestamp = strtotime($request->tanggal_agenda);
        $date = DateTime::createFromFormat('d/m/y H:i', $request->tanggal_agenda);
        $formattedDate = $date->format('Y-m-d H:i:s');
        // dd($formattedDate);
        $agenda->update([
            'nama'=>$request->nama,
            'tanggal_agenda'=>$formattedDate,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect(route('admin.agenda'))->with('success','Berhasil Mengupdate Agenda');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect(route('admin.agenda'))->with('success','Berhasil Menghapus Agenda');
    }
}
