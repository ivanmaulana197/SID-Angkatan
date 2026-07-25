<div class="row mb-3">
    <div class="col-sm-2 mb-3">
        <a href="{{ route('admin.berita.gambar', $berita->slug) }}" class="btn btn-primary">Kelola Gambar</a>
    </div>
    <div class="col-md-10">
        @include('admin.berita.components.carousal')
    </div>
</div>




