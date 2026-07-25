@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Dokumen Kependudukan {{ $penduduk->nama }}</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.kependudukan') }}">Kependudukan</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Dokumen Kependudukan ({{ $penduduk->nama }})</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Dokumen Kependudukan ({{ $penduduk->nama }})</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kependudukan.dokumen.store', $penduduk->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="title">Nama Dokumen</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama Dokumen" value="{{ old('nama') }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_jenis_dokumen">Jenis Dokumen</label>
                    <div class="col-sm-10">
                        <select class="form-select js-choice @if ($errors->has('id_jenis_dokumen')) is-invalid @endif" id="id_jenis_dokumen" size="1" name="id_jenis_dokumen" data-options='{"removeItemButton":true,"placeholder":true, }'>
                            <option value="">Pilih jenis dokumen...</option>
                            @foreach ($jenisDokumen as $data)
                                <option value="{{ $data->id }}" {{ old('id_jenis_dokumen') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_jenis_dokumen')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="file">Tambah Dokumen</label>
                    <div class="col-md-8">
                        <div>
                            <input class="form-control @if ($errors->has('file')) is-invalid @endif" id="file" name="file" type="file" accept=".jpg, .jpeg, .png">
                            @error('file')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="text-warning">
                            * hanya menerima file berformat jpg/png/jpeg.
                        </div>
                        <div class="col-6 p-1 d-none" id="preview-container">
                            <a href="#" data-gallery="preview">
                                <img class="img-fluid rounded" src="#" alt="preview" id="preview" height="100" />
                            </a>
                        </div>
                    </div>
                </div>



                <a href="{{ route('admin.kependudukan.dokumen', $penduduk->id) }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
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
    <script>
        $(document).ready(function() {
            $('#file').change(function() {
                var file = $(this)[0].files[0];
                var fileName = file.name.toLowerCase();
                var fileExt = fileName.split('.').pop();

                if (['jpg', 'jpeg', 'png'].indexOf(fileExt) !== -1) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                        $('#preview-container').removeClass('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    
                    $('#preview-container').addClass('d-none');
                }
            });
        });
    </script>
@endpush
