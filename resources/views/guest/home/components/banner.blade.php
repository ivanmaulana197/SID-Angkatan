<div class="card mb-3" style="border-radius: 30px; object-fit: contain;">
    <div class="carousel slide theme-slider carousel-fade" id="banner" data-bs-ride="carousel">
        <div class="carousel-inner light inner">
            @forelse ($banner as $i=>$banner)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" data-bs-interval="3000">
                    <a href="{{ class_basename($banner)=='Berita'? route('berita.show',$banner->slug):route('informasi-desa.show',$banner->slug) }}">
                        <img class="d-block w-100 img-inner" src="{{ $banner->images[0]->url }}" alt="First slide" />
                    </a>
                    
                    <div class="carousel-caption ">
                        <div class="alert alert-success p-0" role="alert"><h5>{{ $banner->judul }}</h5></div>
                        <a class="badge rounded-pill bg-success " href="{{ class_basename($banner)=='Berita'? route('berita.kategori',$banner->kategori->slug):route('informasi-desa.kategori',$banner->kategori->slug) }}">{{ $banner->kategori->nama }}</a>
                    </div>
                </div>
            @empty
                <div class="carousel-item active" data-bs-interval="500">
                    <a class="post1" href="{{ asset('img-banner-default.png') }}" data-gallery="gallery-1">
                        <img class="d-block w-100 img-inner" src="{{ asset('img-banner-default.png') }}" alt="First slide" />
                    </a>
                    <div class="carousel-caption">
                        <h5 style="color: green">Tidak Ada Berita</h5>
                    </div>
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
</div>

@push('css')
    <style>
        .inner {
            border-radius: 30px;
            max-height: 500px;
        }

        .img-inner {
            object-fit: fill;
            width: 100%;
            height: 500px;
        }

        @media only screen and (max-width: 600px) {
            .inner {
                border-radius: 20px;
                max-height: 300px;
            }

            .img-inner {
                object-fit: fill;
                width: 100%;
                height: 300px;
            }
        }
    </style>
@endpush
