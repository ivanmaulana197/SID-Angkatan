<div class="carousel slide theme-slider text-center" id="gambarBeritaCarousal{{ $berita->id }}" data-ride="carousel">
  
    <div class="carousel-inner rounded arsip">
        @forelse ($berita->images as $i=>$gambar)
            <div class="carousel-item @if ($i == 0) active @endif img-carousel-preview">
                <a class="post1" href="{{ $gambar->url }}" data-gallery="gallery-{{ $berita->id }}">
                    <img class="d-block img-arsip" src="{{ $gambar->url }}" alt="Slide arsip {{ $i + 1 }}" />
                </a>
                
            </div>
        @empty
            <div class="carousel-item active ">
                <a class="post1" href="{{ asset('img-banner-default.png') }}" data-gallery="gallery-{{ $berita->id }} arsip">
                    <img class="d-block img-arsip" src="{{ asset('img-banner-default.png') }}" alt="Slide 1" />
                </a>
            </div>
        @endforelse
        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#gambarBeritaCarousal{{ $berita->id }}" data-bs-slide="prev">
            <span class="fas fa-angle-left"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#gambarBeritaCarousal{{ $berita->id }}" data-bs-slide="next">
            <span class="fas fa-angle-right"></span>
            <span class="sr-only">Next</span>
        </button> --}}
    </div>
</div>

@push('css')
    <style>
        .arsip {
            border-radius: 30px;
            max-height: 70px;
        }

        .img-arsip {
            object-fit: fill;
            width: 100%;
            height: 70px;
        }

        @media screen and (max-width: 600px) {
            .arsip {
                border-radius: 20px;
                max-height: 200px;
            }

            .img-arsip {
                height: 200px;
            }
        }
    </style>
@endpush


