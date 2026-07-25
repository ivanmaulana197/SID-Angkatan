@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Jenis Surat</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.surat.jenis-surat') }}">Jenis Surat</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Dokumen Jenis Surat</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5>Tambah Dokumen Jenis Surat</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat.jenis-surat.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="title">Nama Surat</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama Surat" value="{{ old('nama') }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="title">Syarat Surat</label>
                    <div class="col-sm-10">

                        <table class="table table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th width='1'>Aksi</th>
                                    <th>Nama Persyaratan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($syaratSurat as $data)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" id="{{ $data->id }}" name="syarat[]" value="{{ $data->id }}" @if (is_array(old('syarat')) && in_array($data->id, old('syarat'))) checked @endif>
                                        </td>
                                        <td>
                                            <label for="{{ $data->id }}">{{ $data->nama }}</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <a href="{{ route('admin.surat.jenis-surat') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                </a>
                <button class="btn btn-primary me-2 mb-1" type="submit">
                    <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
