@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah RT</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Dashobard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dusun') }}">Wilayah Administratif Dusun</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.rw', $dusun->id) }}">RW Dusun: "{{ $dusun->nama }}"</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.rt', [$dusun->id,$rw->id]) }}">RT dari RW: "{{ $rw->rw }}", Dusun: "{{ $dusun->nama }}"</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                               Tambah RT
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah RT di RW: {{ $rw->rw }}, Dusun: {{ $dusun->nama }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rt.store', [$dusun->id,$rw->id]) }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="title">Nama RT</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('rt') is-invalid @enderror" type="text" name="rt" placeholder="Masukkan Nama RT" value="{{ old('rt') }}" id="rt">
                        <small class="text-danger">
                            @error('rt')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ketuaRT">Ketua RT</label>
                    <div class="col-sm-10">
                        <select class="form-select js-choice" id="ketuaRT" size="1" name="id_ketua" data-options='{"removeItemButton":true,"placeholder":true, }'>
                            <option value="">Pilih Ketua RT...</option>
                            @foreach ($penduduk as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('id_ketua') == $penduduk->id ? 'selected' : '' }}>NIK: {{ $penduduk->NIK }} - {{ $penduduk->nama }} - {{ $penduduk->dusun->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <a href="{{ route('admin.rt',[$dusun->id,$rw->id]) }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
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
