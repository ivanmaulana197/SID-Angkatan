@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Ubah Password User</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.profile') }}">Profile User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @error('current_password')
        <div class="alert alert-danger" style="margin-top:30px;">
            {{ $message }}
        </div>
    @enderror

    <form action="{{ route('admin.profile.update-password') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">Ubah Password</div>
            </div>
            <div class="card-body bg-light">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <input class="form-control @error('current_password') is-invalid @enderror" id="current_password" type="password" name="current_password" required autofocus value="{{ old('current_password') }}">
                    @error('current_password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="new_password">Password Baru</label>
                    <input class="form-control @error('new_password') is-invalid @enderror" id="new_password" type="password" name="new_password" required value="{{ old('new_password') }}">
                    @error('new_password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="confirm_password">Konfirmasi Password Baru</label>
                    <input class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" type="password" name="confirm_password" required value="{{ old('confirm_password') }}">
                    @error('confirm_password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-sm btn-falcon-default me-3" href="{{ route('admin.profile') }}">Kembali</a>
                <button class="btn btn-sm btn-success" type="submit">Change Password</button>
            </div>
        </div>
    </form>
@endsection
