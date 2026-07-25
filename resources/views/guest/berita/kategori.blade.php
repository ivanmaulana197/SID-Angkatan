@extends('layouts.main')

@push('css')
 
    <style>
        .btn-baca-selengkapnya {
            width: 100%;
            max-width: 250px;
            font-size: 14px;
        }

        @media (max-width: 767px) {
            .btn-baca-selengkapnya {
                max-width: 100%;
                font-size: 12px;
            }
        }

        .tes {
            border-radius: 30px;
            max-height: 200px;
        }

        .img-tes {
            object-fit: fill;
            width: 100%;
            height: 200px;
        }

        @media screen and (max-width: 600px) {
            .tes {
                border-radius: 20px;
                height: 200px;
            }

            .img-tes {
                height: 200px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            @include('guest.berita.component.kategori-berita')
            <div class="row">
                <div class="card p-0 overflow-hidden">
                    <div class="card-body">
                        <h4>BERITA</h4>
                                                <div class="row">
                            @foreach ($berita as $i => $data)
                                <div class="col-12 p-3 @if ($i % 2) bg-200 @endif">
                                    <div class="row">
                                        <div class="col-sm-5 col-md-4">
                                            <div class="position-relative h-sm-100">
                                                @include('guest.berita.component.carousel')
                                                <a class="badge rounded-pill bg-success position-absolute top-0 end-0 me-2 mt-2 fs--2 z-2" href="{{ $data->kategori->slug }}">{{ $data->kategori->nama }}</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-md-8 d-flex flex-column mt-2">
                                            
                                            <div class="d-flex">
                                                <div class="calendar me-2">
                                                    <span class="calendar-month">
                                                        {{ $data->created_at->isoFormat('MMM') }}
                                                    </span>
                                                    <span class="calendar-day">
                                                        {{ $data->created_at->isoFormat('D') }}
                                                    </span>
                                                </div>
                                                <div class="flex-1 fs--1">
                                                    <h5 class="mt-3 mt-sm-0">
                                                        <a class="text-dark fs-0 fs-lg-1" href="product-details.html">{{ $data->judul }}</a>
                                                    </h5>
                                                    <p class="mb-0">by <a href="#!">{{ $data->user->name }}</a> • {{ $data->created_at->locale('id')->diffForHumans() }}
                                                    </p>
                                                    {{-- <a href="#" class="fs-0 text-warning fw-semi-bold">{{ $data->kategori->nama }}</a> --}}
                                                </div>
                                            </div>
        
        
                                            <div class="mt-2 mb-auto" style="max-height: 150px; overflow: none;">
                                                <p>{{ Str::words(strip_tags($data->isi_berita), 20) }}</p>
                                            </div>
        
                                            <div class="mt-auto">
                                                <a class="btn btn-sm btn-success d-lg-block btn-baca-selengkapnya" href="#">
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
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
