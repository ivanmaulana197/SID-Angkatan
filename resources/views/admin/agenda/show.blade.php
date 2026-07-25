@extends('layouts.main')


@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Agenda</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden">
                            <tr>
                                <td>Agenda</td>
                                <td>:</td>
                                <td><span><strong>{{ $agenda->nama }}</strong></span></td>
                            </tr>
                            <tr>
                                <td>Tanggal Agenda</td>
                                <td>:</td>
                                <td><span><strong>@php
                                    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $agenda->tanggal_agenda)->locale('id_ID');
                                    $formattedDate = $date->isoFormat('dddd, HH:mm, D MMMM YYYY');
                                @endphp
                                
                                {{ $formattedDate }}</strong></span></td>
                            </tr>
                            <tr>
                                <td width="300">Keterangan</td>
                                <td width="1">:</td>
                                <td>{!! $agenda->keterangan !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.agenda') }}" class="btn btn-falcon-default">Kembali</a>
                    <a class="btn btn-warning" href="{{ route('admin.agenda.edit', $agenda->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                </div>
            </div>
            
        </div>
    </div>

    
@endsection
