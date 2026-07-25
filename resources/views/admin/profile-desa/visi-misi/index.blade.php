@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Visi dan Misi</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Visi dan Misi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                @if ($visiMisi)
                    Edit
                @else
                    Tambahkan
                @endif
                Visi dan Misi
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.visi-misi.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2" for="visi_misi">Visi Misi</label>
                    <div class="col-md-10">
                        
                            <textarea id="visi_misi" class="form-control tinymce @error('visi_misi') is-invalid @enderror" name="visi_misi">{{ old('visi_misi',$visiMisi->visi_misi ?? "") }}</textarea>
                            <small class="text-danger">
                                @error('visi_misi')
                                    {{ $message }}
                                @enderror
                            </small>
                        
                    </div>
                </div>
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
        selector: '#visi_misi',
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
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount fullscreen',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table fullscreen | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
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
