<div class="row mb-3">
    <div class="col-sm-6 mb-3">
        <div class="card overflow-hidden border h-100 border-success" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Permohonan Surat</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ count($penduduk->permohonanSurat) }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('layanan-mandiri') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-3">
        <div class="card overflow-hidden border h-100 border-success" style="min-width: 12rem">
            <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <h4>Dokumen</h4>
                <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":43594,"prefix":"$"}'>{{ count($penduduk->dokumen) }}</div><a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('layanan-mandiri.dokumen') }}">Lihat<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
        </div>
    </div>
</div>