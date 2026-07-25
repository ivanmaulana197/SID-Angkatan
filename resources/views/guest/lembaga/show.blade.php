@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card mb-3">
                <img class="d-block w-100" src="{{ $lembaga->logo }}" alt="logo" />
                
            </div>
            <div class="row g-0 mb-3">
                <div class="col ">
                    <div class="card mb-3 mb-lg-0">
                        <div class="card-header">
                            <h3 >
                                <a href="#" class="text-decoration-none text-dark">{{ $lembaga->nama }}</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            {{-- body berita --}}
                            {!! $lembaga->deskripsi !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
