@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            
            
            
            <div class="card mb-3">
                @include('guest.berita.component.banner')
                <div class="card-body">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <div class="d-flex">
                                <div class="calendar me-2"><span class="calendar-month">{{ $berita->created_at->isoFormat('MMM') }}</span><span class="calendar-day">{{ $berita->created_at->isoFormat('D') }}</span>
                                </div>
                                <div class="flex-1 fs--1">
                                    <h5 class="fs-0">
                                        <a href="#" class="text-decoration-none text-dark">{{ $berita->judul }}</a>
                                    </h5>
                                    <p class="mb-0">by <a href="{{ route('berita.dibuat-oleh',$berita->user->name) }}" class="text-decoration-none">{{ $berita->user->name }}</a> &bull; {{ $berita->created_at->locale('id')->diffForHumans() }} </p>
                                    <a href="{{ route('berita.kategori',$berita->kategori->slug) }}" class="fs-0 text-warning fw-semi-bold">{{ $berita->kategori->nama }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mt-md-0">
                            <button class="btn btn-falcon-default btn-sm me-2"><span class="fab fa-teamspeak me-1"></span>{{ $berita->diakses }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0 mb-3">
                <div class="col ">
                    <div class="card mb-3 mb-lg-0">
                        <div class="card-body">
                            {{-- body berita --}}
                            {!! $berita->isi_berita !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
