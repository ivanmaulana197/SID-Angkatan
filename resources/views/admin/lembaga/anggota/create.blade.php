@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Anggota Lembaga: {{ $lembaga->nama }}</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga') }}">Lembaga</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga.show', $lembaga->id) }}">Data Lembaga: {{ $lembaga->nama }}</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.lembaga.anggota.store',$lembaga->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-3 col-12 mb-3">
                <div class="card align-items-center">
                    <div class="card-header">
                        <h5 class="fs-1 ">Foto Penduduk</h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="mb-3">
                            <img id="preview_img" class="img-fluid rounded" src="{{ old('foto') ?? asset('img/profile-default.png') }}" alt="" />
                        </div>
                        @error('foto')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                        <div class="mb-3" style="display:none">
                            <label for="file_input" class="form-label">Pilih File</label>
                            <input id="file_input" type="file" class="form-control" name="foto">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-primary d-block mx-auto" onclick="document.getElementById('file_input').click();">Unggah</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h5>Tambah Anggota</h5>
                            <div class="col-12">
                                <a href="{{ route('admin.lembaga.show', $lembaga->id) }}" class="btn btn-sm btn-falcon-default">Kembali ke Data Lembaga</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="id_penduduk">Nama Anggota</label>
                            <div class="col-lg-7">
                                <select class="form-select js-choice" id="id_penduduk" size="1" name="id_penduduk" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih anggota...</option>
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
                            <label class="col-lg-3 col-form-label" for="jabatan">Jabatan</label>
                            <div class="col-lg-7">
                                <select class="form-select js-choice" id="jabatan" size="1" name="jabatan" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih jabatan...</option>
                                    <option value="KETUA" {{ old('jabatan') == 'KETUA' ? 'selected' : '' }}>KETUA</option>
                                    <option value="WAKIL KETUA" {{ old('jabatan') == 'WAKIL KETUA' ? 'selected' : '' }}>WAKIL KETUA</option>
                                    <option value="SEKERTARIS" {{ old('jabatan') == 'SEKERTARIS' ? 'selected' : '' }}>SEKERTARIS</option>
                                    <option value="BENDAHARA" {{ old('jabatan') == 'BENDAHARA' ? 'selected' : '' }}>BENDAHARA</option>
                                    <option value="ANGGOTA" {{ old('jabatan') == 'ANGGOTA' ? 'selected' : '' }}>ANGGOTA</option>
                                </select>
                                @error('jabatan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="jabatan">Keterangan</label>
                            <div class="col-lg-7">
                               <textarea class="form-control" name="keterangan" cols="30" rows="7" placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <a href="{{ route('admin.lembaga.show', $lembaga->id) }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                        </a>
                        <button class="btn btn-primary me-2 mb-1" type="submit">
                            <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('css')
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

    <script>
        $(document).ready(function() {
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
        });
    </script>
@endpush
