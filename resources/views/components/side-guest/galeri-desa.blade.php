<div class="card text-white bg-success mb-2">
    <div class="card-text d-flex justify-content-center p-2 fs-2 fw-bolder" style="color:white">
        GALERI DESA
    </div>
</div>

<div class="card mb-5" style="border-radius: 30px; object-fit: contain;">
    <div class="carousel slide carousel-fade" id="galeriDesaCarousel" data-ride="carousel">
        <div class="carousel-inner light gal-inner">
            @forelse ($myData['galeri'] as $i=>$data)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" data-bs-interval="3000">
                    <a class="post1" href="{{ $data->foto }}" data-gallery="galleri">
                        <img class="d-block w-100 gal-img" src="{{ $data->foto }}" alt="First slide" />
                    </a>
                    <div class="carousel-caption ">
                        <div class="alert alert-success p-0" role="alert">
                            <a class="text-dark" href="{{ route('galeri.show',$data->id) }}">{{ $data->nama }}</a>
                        </div>
                    </div>
                </div>
            @empty
            <div class="carousel-item active" data-bs-interval="500">
                <a class="post1" href="{{ asset('img-banner-default.png') }}" data-gallery="gallery-1">
                    <img class="d-block w-100 " src="{{ asset('img-banner-default.png') }}" alt="First slide" />
                </a>
                <div class="carousel-caption">
                    <h5 style="color: green">Tidak Ada Berita</h5>
                </div>
            </div>
            @endforelse
            
           
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#galeriDesaCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galeriDesaCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</div>
@push('css')
    <style>
        .gal-inner {
            border-radius: 30px;
            max-height: 300px;
        }

        .gal-img {
            object-fit: fill;
            width: 100%;
            height: 300px;
        }

        @media only screen and (max-width: 600px) {
            .gal-inner {
                border-radius: 20px;
                max-height: 300px;
            }

            .gal-img {
                object-fit: fill;
                width: 100%;
                height: 300px;
            }
        }
    </style>
@endpush
