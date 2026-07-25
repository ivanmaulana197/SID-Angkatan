<div class="carousel slide theme-slider text-center" id="gambarInformasiDesaCarousal{{ $informasiDesa->id }}" data-ride="carousel">
    <div class="carousel-indicators">
        @forelse ($informasiDesa->images as $i=>$gambar)
            <button class="@if ($i == 0) active @endif" type="button" data-bs-target="#gambarInformasiDesaCarousal{{ $informasiDesa->id }}" data-bs-slide-to="{{ $i }}" aria-label="Slide {{ $i + 1 }}"></button>

        @empty
            <button class="active" type="button" data-bs-target="#gambarInformasiDesaCarousal{{ $informasiDesa->id }}" data-bs-slide-to="1" aria-current="true" aria-label="Slide Default"></button>
        @endforelse
    </div>
    <div class="carousel-inner rounded tes">
        @forelse ($informasiDesa->images as $i=>$gambar)
            <div class="carousel-item @if ($i == 0) active @endif img-carousel-preview">
                <a class="post1" href="{{ $gambar->url }}" data-gallery="gallery-{{ $informasiDesa->id }}">
                    <img class="d-block img-tes" src="{{ $gambar->url }}" alt="Slide {{ $i + 1 }}" />
                </a>
                {{-- <img class="d-block w-100" src="{{ $gambar->path }}" alt=" Slide {{ $i + 1 }}" /> --}}
            </div>
        @empty
            <div class="carousel-item active ">
                <a class="post1" href="{{ asset('img-banner-default.png') }}" data-gallery="gallery-{{ $informasiDesa->id }}">
                    <img class="d-block img-tes" src="{{ asset('img-banner-default.png') }}" alt="Slide 1" />
                </a>
            </div>
        @endforelse
        <button class="carousel-control-prev" type="button" data-bs-target="#gambarInformasiDesaCarousal{{ $informasiDesa->id }}" data-bs-slide="prev">
            <span class="fas fa-angle-left"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#gambarInformasiDesaCarousal{{ $informasiDesa->id }}" data-bs-slide="next">
            <span class="fas fa-angle-right"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</div>
