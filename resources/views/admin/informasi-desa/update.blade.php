@extends('layouts.main')


@push('css')
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/glightbox/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/dropzone/dropzone.min.css') }}" rel="stylesheet" />

    <style>
        .tes {
            border-radius: 30px;
            max-height: 500px;

        }

        .img-tes {
            object-fit: cover;
            width: 100%;
            height: 500px;
        }

        @media screen and (max-width: 768px) {
            .tes {
                border-radius: 20px;
                height: 300px;
            }

            .img-tes {
                height: 300px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('vendors/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendors/dropzone/dropzone.min.js') }}"></script>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Edit Informasi Desa</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.informasi-desa') }}">Informasi Desa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Informasi Desa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-warning" style="margin-top:30px;">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Edit Informasi Desa : {{ $informasiDesa->judul }}</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.informasi-desa.update', $informasiDesa->slug) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('admin.informasi-desa.components.banner-image')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="judul">Judul</label>
                    <div class="col-sm-6">
                        <input class="form-control  @error('judul') is-invalid @enderror" type="text" name="judul" placeholder="Masukkan Judul Informasi Desa" value="{{ old('judul', $informasiDesa->judul) }}" id="judul">
                        <small class="text-danger">
                            @error('judul')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                </div>
                

                {{-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="gambar">Gambar berita</label>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <input class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar[]" type="file" multiple='multiple'>
                            <small class="text-danger">
                                @error('gambar')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>

                @include('admin.berita.components.preview-image') --}}

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="isi_informasi_desa">Isi Informasi Desa</label>
                    <div class="col-md-10">
                        <div class="min-vh-50">
                            <textarea id="isi_informasi_desa" class="form-control tinymce @error('isi_informasi_desa') is-invalid @enderror" name="isi_informasi_desa">
                                {!! old('isi_informasi_desa', $informasiDesa->isi_informasi_desa) !!}
                            </textarea>
                            <small class="text-danger">
                                @error('isi_informasi_desa')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>



                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_kategori">kategori</label>
                    <div class="col-md-4">
                        <select class="form-select js-choice form-control @error('id_kategori') is-invalid @enderror" id="id_kategori" size="1" name="id_kategori" data-options='{"removeItemButton":true,"placeholder":false}' aria-placeholder="Pilih kategori...">
                            @foreach ($kategori as $data)
                                @if ($data->id == $informasiDesa->id_kategori)
                                    <option value={{ $data->id }} selected>{{ $data->nama }}</option>
                                @else
                                    <option value={{ $data->id }}>{{ $data->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small class="text-danger">
                            @error('id_kategori')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <label class="col-sm-2 col-form-label" for="status">Status</label>
                    <div class="col-md-4">
                        <select class="form-select form-control @error('status') is-invalid @enderror" name="status" data-style="btn-outline-primary" data-size="5">
                            @foreach ($informasiDesa->enumFields['status'] as $status)
                                @if ($status == $informasiDesa->status)
                                    <option value="{{ $status }}" selected>{{ $status }}</option>
                                @else
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endif
                            @endforeach

                        </select>
                        <small class="text-danger">
                            @error('status')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <a href="{{ route('admin.informasi-desa') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                </a>
                <button class="btn btn-primary me-2 mb-1" type="submit">
                    <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                </button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        tinymce.init({
            selector: '#isi_informasi_desa',
            image_class_list: [{
                title: 'img-responsive',
                value: 'img-fluid rounded'
            }, ],
            height: 500,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: 'favs file edit view insert format tools table help',
            image_title: true,
            automatic_uploads: true,

            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            }
        });
    </script>
@endpush
