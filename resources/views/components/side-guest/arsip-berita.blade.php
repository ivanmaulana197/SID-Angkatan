<div class="card text-white bg-success mb-2">
    <div class="card-text d-flex justify-content-center p-2 fs-2 fw-bolder" style="color:white">
        ARSIP BERITA
    </div>
</div>


<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs" id="arsipBeritaTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="arsip-berita-terbaru-tab" data-bs-toggle="tab" href="#tab-arsip-berita-terbaru" role="tab" aria-controls="tab-home" aria-selected="true">Terbaru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="arsip-berita-populer-tab" data-bs-toggle="tab" href="#tab-arsip-berita-populer" role="tab" aria-controls="tab-arsip-berita-populer" aria-selected="false">Populer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="arsip-berita-acak-tab" data-bs-toggle="tab" href="#tab-arsip-berita-acak" role="tab" aria-controls="tab-arsip-berita-acak" aria-selected="false">Acak</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content border border-top-0 p-3" id="arsipBeritaTabContent">
            <div class="tab-pane fade show active" id="tab-arsip-berita-terbaru" role="tabpanel" aria-labelledby="arsip-berita-terbaru-tab">
                <div class="row">
                    @forelse ($myData['berita-terbaru'] as $i => $berita)
                        <div class="col-12 p-2 @if ($i % 2) bg-200 @endif mb-2">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <div class="position-relative h-sm-100">

                                        @include('components.side-guest.arsip-berita.carousal')
                                        {{-- <a class="badge rounded-pill bg-success position-absolute top-0 end-0 me-2 mt-2 fs--2 z-2" href="#">{{ $berita->kategori->nama }}</a> --}}
                                    </div>
                                </div>
                                <div class="col-sm-7 col-md-8 d-flex flex-column">
                                    <h6 class="mt-3 mt-sm-0">
                                        <a class="text-dark fs-0 fs-lg-1" href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                    </h6>
                                    <div class="d-flex">
                                        <div class="flex-1 fs--1">
                                            <p class="mb-0">by <a href="{{ route('berita.dibuat-oleh', $berita->user->name) }}">{{ $berita->user->name }}</a> • {{ $berita->created_at->locale('id')->diffForHumans() }}
                                            </p>
                                            <a href="{{ route('berita.kategori', $berita->kategori->slug) }}" class="fs--1 text-success fw-semi-bold">{{ $berita->kategori->nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 p-2 text-center">
                            <h6>Belum ada berita</h6>
                        </div>
                    @endforelse

                </div>
            </div>
            <div class="tab-pane fade" id="tab-arsip-berita-populer" role="tabpanel" aria-labelledby="arsip-berita-populer-tab">
                <div class="row">
                    @forelse ($myData['berita-terpopuler'] as $i => $berita)
                        <div class="col-12 p-2 @if ($i % 2) bg-200 @endif mb-2">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <div class="position-relative h-sm-100">

                                        @include('components.side-guest.arsip-berita.carousal')
                                        {{-- <a class="badge rounded-pill bg-success position-absolute top-0 end-0 me-2 mt-2 fs--2 z-2" href="#">{{ $berita->kategori->nama }}</a> --}}
                                    </div>
                                </div>
                                <div class="col-sm-7 col-md-8 d-flex flex-column">
                                    <h6 class="mt-3 mt-sm-0">
                                        <a class="text-dark fs-0 fs-lg-1" href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                    </h6>
                                    <div class="d-flex">
                                        <div class="flex-1 fs--1">
                                            <p class="mb-0">by <a href="{{ route('berita.dibuat-oleh', $berita->user->name) }}">{{ $berita->user->name }}</a> • {{ $berita->created_at->locale('id')->diffForHumans() }}
                                            </p>
                                            <a href="{{ route('berita.kategori', $berita->kategori->slug) }}" class="fs--1 text-success fw-semi-bold">{{ $berita->kategori->nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 p-2 text-center">
                            <h6>Belum ada berita</h6>
                        </div>
                    @endforelse

                </div>
            </div>
            <div class="tab-pane fade" id="tab-arsip-berita-acak" role="tabpanel" aria-labelledby="arsip-berita-acak-tab">
                <div class="row">
                    @forelse ($myData['berita-acak'] as $i => $berita)
                        <div class="col-12 p-2 @if ($i % 2) bg-200 @endif mb-2">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <div class="position-relative h-sm-100">
                                        @include('components.side-guest.arsip-berita.carousal')
                                        {{-- <a class="badge rounded-pill bg-success position-absolute top-0 end-0 me-2 mt-2 fs--2 z-2" href="#">{{ $berita->kategori->nama }}</a> --}}
                                    </div>
                                </div>
                                <div class="col-sm-7 col-md-8 d-flex flex-column">
                                    <h6 class="mt-3 mt-sm-0">
                                        <a class="text-dark fs-0 fs-lg-1" href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                    </h6>
                                    <div class="d-flex">
                                        <div class="flex-1 fs--1">
                                            <p class="mb-0">by <a href="{{ route('berita.dibuat-oleh', $berita->user->name) }}">{{ $berita->user->name }}</a> • {{ $berita->created_at->locale('id')->diffForHumans() }}
                                            </p>
                                            <a href="{{ route('berita.kategori', $berita->kategori->slug) }}" class="fs--1 text-success fw-semi-bold">{{ $berita->kategori->nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 p-2 text-center">
                            <h6>Belum ada berita</h6>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
    <div class="card-footer bg-light p-0 border-top">
        <a class="btn btn-success d-block w-100" href="{{ route('berita') }}">Baca Lainnya<span class="fas fa-chevron-right ms-1 fs--2"></span></a>
    </div>
</div>
