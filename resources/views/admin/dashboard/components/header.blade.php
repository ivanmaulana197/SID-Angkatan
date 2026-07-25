<div class="row">
    <div class="col-md-4 col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-1.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Penduduk</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['penduduk'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.kependudukan') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-2.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Kartu Keluarga</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['kk'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.keluarga') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
        
    </div>
    <div class="col-md-4 col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Lembaga Desa</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['lembaga'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.lembaga') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>

    {{-- media --}}
    <div class="col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-1.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Berita Desa</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['berita'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.berita') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-2.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Informasi Desa Desa</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['info-desa'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.informasi-desa') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Agenda Desa</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['agenda'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.agenda') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-6 mb-3">
        <div class="card overflow-hidden border h-100 border-info" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-1.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Galeri Desa</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ $data['galeri'] }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.galeri') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
</div>