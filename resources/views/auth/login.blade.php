@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body p-4 p-sm-5">
            <div class="row d-flex flex-column flex-center mb-2">
                <a class="d-flex flex-center flex-column" href="/">
                    <img class="me-2" src="{{ $myData['desa']->logo }}" alt="" width="100rem">
                    <span class="font-sans-serif fw-bolder fs-3 d-inline-block text-success">Desa {{ $myData['desa']->nama }}</span>
                </a>
                <span class="col-auto text-center fx--2">{!! $myData['desa']->alamat !!}</span>
            </div>

            <div class="row flex-center mb-2">
                <div class="col-auto">
                    <h5>Log in Admin</h5>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="col mb-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <p class="card-text">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlInput1">Username</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Pengguna">
                    @error('name')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlInput1">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                    @error('password')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row flex-between-center">
                    <div class="col-auto">
                        <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="basic-checkbox" checked="checked" name="remember"><label class="form-check-label mb-0" for="basic-checkbox">Remember me</label></div>
                    </div>
                    
                </div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log in</button></div>
            </form>

        </div>
    </div>
@endsection
