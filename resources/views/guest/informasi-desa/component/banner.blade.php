<div class="carousel slide theme-slider text-center" id="banner" data-ride="carousel">
    <div class="carousel-indicators">
        @forelse ($informasiDesa->images as $i => $data)
            <button class="{{ $i == 0 ? 'active' : '' }}" type="button" data-bs-target="#banner" data-bs-slide-to="{{ $i }}" aria-current="true" aria-label="Slide {{ $i }}">
            </button>
        @empty
            <button class="active" type="button" data-bs-target="#banner" data-bs-slide-to="0" aria-current="true" aria-label="Slide 0">
            </button>
        @endforelse
    </div>
    <div class="carousel-inner rounded inner">
        @forelse ($informasiDesa->images as $i => $data)
            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" data-bs-interval="300">
                <a class="post1" href="{{ $data->url }}" data-gallery="gallery-informasi-desa-show-{{ $i }}">
                    <img class="d-block w-100 img-inner" src="{{ $data->url }}" alt="Slide {{ $i }}" />
                </a>
            </div>
        @empty
            <div class="carousel-item active inner">
                <a class="post1" href="{{ asset('img-banner-default.png') }}" data-gallery="gallery-{{ $informasiDesa->id }}">
                    <img class="d-block img-tes img-inner" src="{{ asset('img-banner-default.png') }}" alt="Slide 1" />
                </a>
            </div>
        @endforelse

        <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
            <span class="fas fa-angle-left"></span>
            <span class="sr-only">Previous</span>
        </button><button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
            <span class="fas fa-angle-right"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</div>

@push('css')
    <style>
        .inner {
            border-radius: 30px;
            max-height: 400px;
        }

        .img-inner {
            object-fit: fill;
            width: 100%;
            height: 400px;
        }

        @media only screen and (max-width: 600px) {
            .inner {
                border-radius: 20px;
                max-height: 200px;
            }

            .img-inner {
                object-fit: fill;
                width: 100%;
                height: 200px;
            }
        }
    </style>
@endpush
