@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    AGENDA DESA
                </h5>
            </div>
            

            <div class="card p-0 overflow-hidden">
                <div class="card-body">
                    <h4>AGENDA</h4>
                    <div class="row">
                        @forelse ($agenda as $i => $data)
                            <div class="col-12 p-3 @if ($i % 2) bg-200 @endif">
                                <div class="row">
                                    <div class="col-12 d-flex flex-column mt-2">
                                        <div class="d-flex">
                                            <div class="calendar me-2">
                                                <span class="calendar-month">
                                                    {{ date('M', strtotime($data->tanggal_agenda)) }}
                                                </span>
                                                <span class="calendar-day">
                                                    {{ date('d', strtotime($data->tanggal_agenda)) }}
                                                </span>
                                            </div>
                                            <div class="flex-1 fs--1">
                                                <h5 class="mt-3 mt-sm-0">
                                                    <a class="text-dark fs-0 fs-lg-1" href="{{ route('agenda.show', $data->id) }}">{{ $data->nama }}</a>
                                                </h5>
                                                <p class="mb-0">
                                                    @php
                                                        $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal_agenda)->locale('id_ID');
                                                        $formattedDate = $date->isoFormat('dddd, HH:mm, D MMMM YYYY');
                                                    @endphp

                                                    {{ $formattedDate }}
                                                </p>
                                                <div class="mt-2 mb-auto" style="max-height: 150px; overflow: none;">
                                                    <h6 class="fw-normal">{{ Str::words(strip_tags($data->keterangan), 20) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="mt-auto">
                                            <a class="btn btn-sm btn-success d-lg-block btn-baca-selengkapnya" href="{{ route('agenda.show', $data->id) }}">
                                                <i class="fa-regular fa-eye"></i>
                                                <span class="ms-2">Baca Selengkapnya</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 p-3 d-flex justify-content-center align-items-center">
                                <h4>Tidak Ada Agenda</h4>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer border-top d-flex justify-content-center">
                    {{ $agenda->onEachSide(1)->links() }}
                </div>
            </div>

        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
