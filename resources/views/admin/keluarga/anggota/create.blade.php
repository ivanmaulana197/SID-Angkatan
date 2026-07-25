@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Anggota Keluarga</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Keluarga</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Anggota Keluarga dengan No. KK: {{ $kk->no_kk }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.keluarga.penduduk.store',$kk->id) }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                        <label class="form-label" for="id_penduduk">Anggota Keluarga</label>
                        <select class="form-select js-choice" id="id_penduduk" size="1" name="id_penduduk" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                            <option value="">Pilih keluarga...</option>
                            @foreach ($penduduk as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('id_penduduk') == $penduduk->id ? 'selected' : '' }}>NIK: {{ $penduduk->NIK }} - {{ $penduduk->nama }}</option>
                            @endforeach

                        </select>
                        @error('id_penduduk')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12 mb-2">
                        <label class="form-label" for="id_kk">Nomor KK</label>
                        <input class="form-control  @error('no_kk') is-invalid @enderror" type="number" name="no_kk" placeholder="Masukkan Nomor KK" value="{{ old('no_kk',$kk->no_kk) }}" id="no_kk" readonly>
                        @error('no_kk')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>

                <a href="{{ route('admin.keluarga') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
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
    <link href="{{ asset('/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush
