@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Lembaga</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga') }}">Lembaga</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Tambah Lembaga</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Lembaga</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.lembaga.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-lg-2 col-form-label" for="logo">Logo</label>
                    <div class="col-lg-7">
                        <div>
                            <img id="preview_img" class="img-fluid rounded mb-3" src="{{ asset('img/profile-default.png') }}" alt="" width="200px" />
                            <div class="mb-3" style="display:none">
                                <label for="file_input" class="form-label">Pilih File</label>
                                <input id="file_input" type="file" class="form-control" name="logo">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('file_input').click();">Unggah</button>
                            </div>
                        </div>
                        @error('logo')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                        
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-lg-2 col-form-label" for="nama">Nama Lembaga</label>
                    <div class="col-lg-7">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama Lembaga" value="{{ old('nama') }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                    <div class="col-sm-10">
                        <div class="min-vh-50">
                            <textarea id="deskripsi" class="form-control tinymce @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            <small class="text-danger">
                                @error('deskripsi')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-lg-2 col-form-label" for="id_ketua_lembaga">Ketua Lembaga</label>
                    <div class="col-lg-7">
                        <select class="form-select js-choice" id="id_ketua_lembaga" size="1" name="id_ketua_lembaga" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}' >
                            <option value="">Pilih ketua...</option>
                            @foreach ($penduduk as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('id_ketua_lembaga') == $penduduk->id ? 'selected' : '' }}>NIK: {{ $penduduk->NIK }} - {{ $penduduk->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_ketua_lembaga')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>

                <a href="{{ route('admin.lembaga') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
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
    <script>
        tinymce.init({
            selector: '#deskripsi',
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
            plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount fullscreen',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image table fullscreen| align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
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
