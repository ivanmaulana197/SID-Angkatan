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
            @include('guest.home.components.banner')
            @include('guest.home.components.berita')
            @include('guest.home.components.informasi-desa')
            @include('guest.home.components.data-statistik-penduduk')
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
