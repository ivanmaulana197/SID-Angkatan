@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../../assets/img/icons/spot-illustrations/corner-4.png);"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Edit User Akun</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.setting.user') }}">Pengaturan</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.setting.user') }}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5>Edit Akun User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.user.update', $user->id) }}" method="post">
                @method('put')
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="title">Username</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('name') is-invalid @enderror" type="text" name="name" placeholder="Masukkan Username" value="{{ old('name', $user->name) }}" id="name">
                        <small class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="fullName">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('fullName') is-invalid @enderror" type="text" name="fullName" placeholder="Masukkan Nama Lengkap" value="{{ old('fullName',$user->fullName) }}" id="fullName">
                        <small class="text-danger">
                            @error('fullName')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="role">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select js-choice  @if($errors->has('role')) is-invalid @endif" id="role" multiple="multiple" size="1" data-options='{"removeItemButton":true,"placeholder":true}' name="role[]">
                            <option value="">Select Rolenya...</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @if (in_array($role->name, old('roles', $user->getRoleNames()->toArray()))) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <small class="text-danger">
                                {{ $errors->first('role') }}
                            </small>
                        @endif
                    </div>
                </div>
                <a href="{{ route('admin.setting.user') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                </a>
                <button class="btn btn-primary me-2 mb-1" type="submit">
                    <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
@endpush
