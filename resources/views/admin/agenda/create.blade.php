@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Agenda</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.agenda') }}">Agenda</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Tambah Agenda</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Agenda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.agenda.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-lg-2 col-form-label" for="nama">Nama Agenda</label>
                    <div class="col-lg-7">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama Agenda" value="{{ old('nama') }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="datepicker">Start Date</label>
                    <div class="col-sm-7">
                        <input class="form-control datetimepicker  @error('tanggal_agenda') is-invalid @enderror" id="datetimepicker" type="text" placeholder="d/m/y H:i" data-options='{"enableTime":true,"dateFormat":"d/m/y H:i","disableMobile":true}' name="tanggal_agenda" value="{{ old('tanggal_agenda') }}" />
                        @error('tanggal_agenda')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                    <div class="col-sm-10">
                        <div class="min-vh-50">
                            <textarea id="keterangan" class="form-control tinymce @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan') }}</textarea>
                            <small class="text-danger">
                                @error('keterangan')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>


                <a href="{{ route('admin.agenda') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
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
        tinymce.init({
            selector: '#keterangan',
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
