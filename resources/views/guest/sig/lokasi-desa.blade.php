@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    LOKASI DESA
                </h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-body d-flex justify-content-center pt-1">
                        {!!  $data ?? 'Gagal Memuat' !!}
                    </div>
                </div>
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
