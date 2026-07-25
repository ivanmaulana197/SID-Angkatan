@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <div class="d-flex">
                                <div class="calendar me-2">
                                    <span class="calendar-month">
                                        {{ date('M', strtotime($agenda->tanggal_agenda)) }}
                                    </span>
                                    <span class="calendar-day">
                                        {{ date('d', strtotime($agenda->tanggal_agenda)) }}
                                    </span>
                                </div>
                                <div class="flex-1 fs--1">
                                    <h5 class="fs-0">
                                        <a href="#" class="text-decoration-none text-dark">{{ $agenda->nama }}</a>
                                    </h5>
                                    <p class="mb-0">
                                        @php
                                            $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $agenda->tanggal_agenda)->locale('id_ID');
                                            $formattedDate = $date->isoFormat('dddd, HH:mm, D MMMM YYYY');
                                        @endphp
                                        {{ $formattedDate }} 
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row g-0 mb-3">
                <div class="col ">
                    <div class="card mb-3 mb-lg-0">
                        <div class="card-body">
                            <a href="{{ route('agenda') }}" class="btn btn-sm btn-success mb-2">Semua Agenda</a>
                            {!! $agenda->keterangan !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
