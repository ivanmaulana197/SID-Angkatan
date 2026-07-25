<div class="row mb-3">
    @foreach ($kategori as $data)
        <div class="col-sm-3">
            <div class="card overflow-hidden border h-100 border-success" style="min-width: 12rem">
                <div class="bg-holder bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
                <!--/.bg-holder-->
                <div class="card-body position-relative">
                    <h4>{{ $data->nama }}</h4>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif" data-countup='{"endValue":{{ count($data->informasi_desa()->where('status', 'PUBLISHED')->get()) }},"prefix":"Jumlah"}'>
                        {{ count($data->informasi_desa()->where('status', 'PUBLISHED')->get()) }}
                    </div>
                    <a class="fw-semi-bold fs--1 text-nowrap" 
                    href="{{ route('informasi-desa.kategori',$data->slug) }}">Lihat
                    <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>

                </div>
            </div>
        </div>
    @endforeach
</div>