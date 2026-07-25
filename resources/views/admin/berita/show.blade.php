@extends('layouts.main')

@push('css')
    <style>
        .tes {
            border-radius: 30px;
            max-height: 500px;

        }

        .img-tes {
            object-fit: cover;
            width: 100%;
            height: 500px;
        }

        @media screen and (max-width: 768px) {
            .tes {
                border-radius: 20px;
                height: 300px;
            }

            .img-tes {
                height: 300px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Berita</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                @include('admin.berita.components.carousal')

                <div class="card-body">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <div class="d-flex">
                                <div class="calendar me-2"><span class="calendar-month">{{ $berita->created_at->isoFormat('MMM') }}</span><span class="calendar-day">{{ $berita->created_at->isoFormat('D') }} </span>
                                </div>
                                <div class="flex-1 fs--1">
                                    <h5 class="fs-0">{{ $berita->judul }}</h5>
                                    <p class="mb-0">by <a href="#!">{{ $berita->user->name }}</a> • {{ $berita->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto mt-4 mt-md-0">
                            <button class="btn btn-falcon-default btn-sm me-2" type="button">
                                <span class="fas fa-eye text-danger me-1"></span>
                                 {{ $berita->diakses }}
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('admin.berita') }}" class="btn btn-falcon-default me-1 mb-1">
                            <i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="{{ route('admin.berita.edit', $berita->slug) }}" class="btn btn-warning me-1 mb-1">
                            <i class="bi bi-pencil"></i> Edit</a>


                        {{-- <form action="{{ route('hapus-berita', [$post->slug]) }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger me-1 mb-1"><span class="bi bi-trash"></span> Delete</button>
                        </form> --}}

                    </div>
                    {!! $berita->isi_berita !!}
                </div>
            </div>
        </div>
    </div>

    
@endsection
