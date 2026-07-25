@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    Hasil Pencarian {{ $key }}
                </h5>
            </div>
            <div class="card">
                <div class="card-body">
                    @foreach ($pagedData->items() as $index => $data)
                        @php
                            // dd($data->images);
                            $kBerita = class_basename($data) == 'Berita' ? true : false;
                            $kInfo = class_basename($data) == 'InformasiDesa' ? true : false;
                            $kAgenda = class_basename($data) == 'Agenda' ? true : false;
                        @endphp
                        <div class="col-12 p-3 @if ($index % 2) bg-200 @endif">
                            <div class="row">
                                @if ($kAgenda)
                                @else
                                    <div class="col-sm-5 col-md-4">
                                        <div class="position-relative h-sm-100">
                                            @include('guest.search.carousel')
                                            <a class="badge rounded-pill bg-success position-absolute top-0 end-0 me-2 mt-2 fs--2 z-2" href="{{ route($kInfo ? 'informasi-desa.kategori' : 'berita.kategori', $data->kategori->slug) }}">{{ $data->kategori->nama }}</a>
                                        </div>
                                    </div>
                                @endif
                                <div class="{{ $kAgenda ? 'col' : 'col-sm-7 col-md-8' }} d-flex flex-column mt-2">
                                    <div class="d-flex">
                                        <div class="calendar me-2">
                                            <span class="calendar-month">
                                                {{ $kAgenda ? date('M', strtotime($data->tanggal_agenda)) : $data->created_at->isoFormat('MMM') }}

                                            </span>
                                            <span class="calendar-day">
                                                {{ $kAgenda ? date('d', strtotime($data->tanggal_agenda)) : $data->created_at->isoFormat('D') }}
                                            </span>
                                        </div>
                                        <div class="flex-1 fs--1">
                                            <h5 class="mt-sm-0">
                                                <a class="text-dark fs-0 fs-lg-1" href="{{ route(($kBerita ? 'berita.show' : $kInfo) ? 'informasi-desa.show' : 'agenda.show', $kAgenda ? $data->id : $data->slug) }}">
                                                    {{ $kAgenda ? $data->nama : $data->judul }}
                                                </a>
                                            </h5>
                                            <p class="mb-0">
                                                @if ($kAgenda)
                                                    @php
                                                        $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal_agenda)->locale('id_ID');
                                                        $formattedDate = $date->isoFormat('dddd, HH:mm, D MMMM YYYY');
                                                    @endphp

                                                    {{ $formattedDate }}
                                                @else
                                                    by <a href="{{ route($kBerita ? 'berita.dibuat-oleh' : 'informasi-desa.dibuat-oleh', $data->user->name) }}">{{ $data->user->name }}</a> •
                                                    {{ $data->created_at->locale('id')->diffForHumans() }}
                                                @endif
                                            </p>
                                            @if ($kAgenda)
                                            <div class="mt-2 mb-auto" style="max-height: 150px; overflow: none;">
                                                <h6 class="fw-normal">{{ Str::words(strip_tags($data->keterangan), 20) }}</h6>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($kAgenda)
                                    @else
                                        <div class="mt-2 mb-auto" style="max-height: 150px; overflow: none;">
                                            @php
                                                $isi = '';
                                                if ($kBerita) {
                                                    $isi = $data->isi_berita;
                                                } elseif ($kInfo) {
                                                    $isi = $data->isi_informasi_desa;
                                                }
                                                
                                            @endphp
                                            <p>{{ Str::words(strip_tags($isi), 20) }}</p>
                                        </div>
                                    @endif

                                    <div class="mt-auto">
                                        <a class="btn btn-sm btn-success d-lg-block btn-baca-selengkapnya" href="{{ route($kBerita ? 'berita.show' : ($kInfo ? 'informasi-desa.show' : 'agenda.show'), $kAgenda ? $data->id : $data->slug) }}">
                                            <i class="fa-regular fa-eye"></i>
                                            <span class="ms-2">Baca Selengkapnya</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
