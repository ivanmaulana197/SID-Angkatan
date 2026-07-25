@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Data Galeri</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dusun') }}"> Galeri</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data Galeri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Data Galeri</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.galeri.update',$galeri->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="title">Nama</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama/keterangan" value="{{ old('nama',$galeri->nama) }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kepalaDusun">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" name="foto" id="file_input" class="form-control @error('foto') is-invalid @enderror mb-2">
                        @error('foto')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                        
                        <img id="preview_img" class="img-fluid rounded" src="{{ $galeri->foto }}" alt="" />

                    </div>
                </div>

                <a href="{{ route('admin.galeri') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                </a>
                <button class="btn btn-primary me-2 mb-1" type="submit">
                    <i class="fa-duotone fa-floppy-disk"></i> Simpan
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
        $('#file_input').change(function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            // Ketika file telah selesai di-load
            reader.onload = function(e) {
                // Ubah href dari a tag dengan id preview_img
                // Ubah src dari img tag yang menjadi child dari a tag tersebut
                $('#preview_img').attr('src', e.target.result);
            }

            reader.readAsDataURL(file);
        });
        
    </script>
@endpush
