<div class="row mb-3">
    <div class="col-sm-2 mb-3">
        <a href="{{ route('admin.informasi-desa.gambar', $informasiDesa->slug) }}" class="btn btn-primary">Kelola Gambar</a>
    </div>
    <div class="col-md-10">
        @include('admin.informasi-desa.components.carousal')
    </div>
</div>




