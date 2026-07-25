<div class="card mb-3">
    <div class="card-body">
        <div class="card text-white bg-success mb-2">
            <a href="{{ route('informasi-desa') }}" class="card-text d-flex justify-content-center p-2 fs-1 fw-bolder" style="color:white;border-radius: 30px;">
                LAPORAN INFORMASI DESA
            </a>
        </div>

        <div class="card">
            <div class="card-body p-0 overflow-hidden">
                <div class="row">
                    @forelse ($informasiDesas as $i => $informasiDesa)
                        <div class="col-12 p-4 @if ($i % 2) bg-200 @endif">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <div class="position-relative h-sm-100">
                                        @include('admin.informasi-desa.components.carousal')
                                        <a class="badge rounded-pill bg-success position-absolute top-0 end-0 me-2 mt-2 fs--2 z-2" href="{{ route('informasi-desa.kategori', $informasiDesa->kategori->slug) }}">{{ $informasiDesa->kategori->nama }}</a>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-md-8 d-flex flex-column mt-2">
                                    <div class="d-flex">
                                        <div class="calendar me-2">
                                            <span class="calendar-month">
                                                {{ $informasiDesa->created_at->isoFormat('MMM') }}
                                            </span>
                                            <span class="calendar-day">
                                                {{ $informasiDesa->created_at->isoFormat('D') }}
                                            </span>
                                        </div>
                                        <div class="flex-1 fs--1">
                                            <h5 class="mt-3 mt-sm-0">
                                                <a class="text-dark fs-0 fs-lg-1" href="{{ route('informasi-desa.show', $informasiDesa->slug) }}">{{ $informasiDesa->judul }}</a>
                                            </h5>
                                            <p class="mb-0">by <a href="{{ route('berita.dibuat-oleh', $informasiDesa->user->name) }}">{{ $informasiDesa->user->name }}</a> • {{ $informasiDesa->created_at->locale('id')->diffForHumans() }}
                                            </p>

                                        </div>
                                    </div>



                                    <div class="mb-auto" style="max-height: 150px; overflow: none;">
                                        <p>{{ Str::words(strip_tags($informasiDesa->isi_informasi_desa), 20) }}</p>
                                    </div>

                                    <div class="mt-auto">
                                        <a class="btn btn-sm btn-success d-lg-block btn-baca-selengkapnya" href="{{ route('informasi-desa.show', $informasiDesa->slug) }}">
                                            <i class="fa-regular fa-eye"></i>
                                            <span class="ms-2">Baca Selengkapnya</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 p-4 text-center">
                            <h6>Belum ada Informasi Desa</h6>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer border-top d-flex justify-content-center">
                {{ $informasiDesas->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

</div>
