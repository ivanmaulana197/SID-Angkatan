@extends('layouts.main')

@push('css')
@endpush
@section('content')
    
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    LEMBAGA MASYARAKAT
                </h5>
            </div>
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        @foreach ($lembaga as $i => $data)
                            <div class="col-12 p-3 @if ($i % 2) bg-200 @endif">
                                <div class="row">
                                    <div class="col-sm-5 col-md-4">
                                        <div class="d-flex justify-content-center h-sm-100">
                                            <img src="{{ $data->logo }}" alt="logo">
                                        </div>
                                    </div>
                                    <div class="col-sm-7 col-md-8 d-flex flex-column mt-2">
                                        <div class="d-flex">

                                            <div class="flex-1 fs--1">
                                                <h5 class="mt-3 mt-sm-0">
                                                    <a class="text-dark fs-0 fs-lg-1" href="{{ route('lembaga.show', $data->slug) }}">{{ $data->nama }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="mt-2 mb-auto" style="max-height: 150px; overflow: none;">
                                            <p>{{ Str::words(strip_tags($data->deskripsi), 20) }}</p>
                                        </div>

                                        <div class="mt-auto">
                                            <a class="btn btn-sm btn-success d-lg-block btn-baca-selengkapnya" href="{{ route('lembaga.show', $data->slug) }}">
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
                <div class="card-footer border-top d-flex justify-content-center">
                    {{-- {{ $berita->onEachSide(1)->links() }} --}}
                </div>
            </div>
            <div class="card-footer border-top d-flex justify-content-center">
                {{ $lembaga->onEachSide(1)->links() }}
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
