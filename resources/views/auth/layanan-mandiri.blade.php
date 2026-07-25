@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body p-4 p-sm-5">
            <div class="row d-flex flex-column flex-center mb-2">
                <a class="d-flex flex-center flex-column" href="/">
                    <img class="me-2" src="{{ $myData['desa']->logo }}" alt="" width="100rem">
                    <span class="font-sans-serif fw-bolder fs-3 d-inline-block">Desa {{ $myData['desa']->nama }}</span>
                </a>
                <span class="col-auto text-center fx--2">{!! $myData['desa']->alamat !!}</span>
            </div>

            <div class="row flex-center mb-2">
                <div class="col-auto">
                    <h5>Layanan Mandiri</h5>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="col mb-3">

                    <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                        <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">{{ session('message') }}</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                </div>
            @endif
            <form action="{{ route('layanan-mandiri.authenticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlInput1">NIK</label>
                    <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{ old('nik') }}" maxlength="16">
                    @error('nik')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlInput1">PIN</label>
                    <input type="password" name="pin" class="form-control" placeholder="Masukkan PIN" maxlength="6">
                    @error('pin')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row flex-between-center">
                    <div class="col-auto">
                        <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="basic-checkbox" checked="checked" name="remember"><label class="form-check-label mb-0" for="basic-checkbox">Remember me</label></div>
                    </div>
                    
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" type="submit">Log in</button>
                </div>
            </form>

        </div>
    </div>
@endsection
