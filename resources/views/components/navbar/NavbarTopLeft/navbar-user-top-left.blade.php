<ul class="navbar-nav nav nav-pills" data-top-nav-dropdowns="data-top-nav-dropdowns">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'bg-success text-white text-center' : '' }}" href="{{ route('home') }}">BERANDA</a>
    </li>

    @if (request()->is('layanan-mandiri*') && auth('penduduk_layanan_mandiri')->check())
        <li class="nav-item">
            <a class="nav-link {{ request()->is('layanan-mandiri') ? 'bg-success text-white text-center' : '' }}" href="{{ route('layanan-mandiri') }}" aria-haspopup="true" aria-expanded="false">LAYANAN MANDIRI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('layanan-mandiri/dokumen') ? 'bg-success text-white text-center' : '' }}" href="{{ route('layanan-mandiri.dokumen') }}" aria-haspopup="true" aria-expanded="false">DOKUMEN</a>
        </li>
    @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="profile-desa">PROFILE DESA</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="profile-desa">
                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('visi-misi') }}"><i class="fa-sharp fa-solid fa-bullseye-arrow"></i> Visi & Misi Desa</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('pemerintah-desa') }}"><i class="fa-duotone fa-sitemap"></i> Pemerintah Desa</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('sejarah-desa') }}"><i class="fa-duotone fa-monument"></i> Sejarah Desa</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-media">MEDIA</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="nav-media">
                <div class="card navbar-card-pages shadow-none dark__bg-1000">
                    <div class="card-body scrollbar max-h-dropdown">
                        <img class="img-dropdown" src="{{ asset('assets/img/icons/spot-illustrations/authentication-corner.png') }}" width="130" alt="">
                        <div class="row">
                            <div class="col-6 col-xxl-3">
                                <div class="nav flex-column">
                                    <p class="nav-link text-900 mb-0 fw-bold">BERITA</p>
                                    <a class="nav-link py-1 link-600 fw-medium" href="{{ route('berita') }}">Semua Berita</a>
                                    @foreach ($myData['kategori-berita'] as $data)
                                        <a class="nav-link py-1 link-600 fw-medium" href="{{ route('berita.kategori', $data->slug) }}">{{ $data->nama }}</a>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-6 col-xxl-3">
                                <div class="nav flex-column">
                                    <p class="nav-link text-900 mb-0 fw-bold">INFORMASI DESA</p>
                                    <a class="nav-link py-1 link-600 fw-medium" href="{{ route('informasi-desa') }}">Semua Informasi Desa</a>
                                    @foreach ($myData['kategori-informasi-desa'] as $data)
                                        <a class="nav-link py-1 link-600 fw-medium" href="{{ route('informasi-desa.kategori', $data->slug) }}">{{ $data->nama }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-informasi-desa">LEMMAS</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="nav-informasi-dese">
                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('lembaga') }}"><i class="fa-duotone fa-border-all"></i> Semua Lembaga</a>
                    @foreach ($myData['lembaga-desa'] as $data)
                        <a class="dropdown-item link-600 fw-medium" href="{{ route('lembaga.show',$data->slug) }}"> {{ $data->nama }}</a>
                    @endforeach
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-informasi-desa">DATA DESA</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="nav-informasi-dese">
                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.wilayah-administratif') }}"><i class="fa-duotone fa-earth-asia"></i> Data Wilayah Administratif</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.agama') }}"><i class="fa-regular fa-mosque"></i> Data Agama</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.jenisKelamin') }}"><i class="fa-regular fa-restroom-simple"></i> Data Jenis Kelammin</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.pendidikanKK') }}"><i class="fa-regular fa-school"></i> Data Pendidikan KK</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.pendidikan') }}"><i class="fa-regular fa-school"></i> Data Pendidikan Ditempuh</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.pekerjaan') }}"><i class="fa-regular fa-user-helmet-safety"></i> Data Pekerjaan</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('data-desa.usia') }}"><i class="fa-duotone fa-cake-candles"></i> Data Rentang Usia</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-informasi-desa">SIG</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="nav-informasi-dese">
                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('sig.lokasi-desa') }}"><i class="fa-sharp fa-solid fa-bullseye-arrow"></i> Lokasi Desa</a>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('sig.lokasi-kantor-desa') }}"><i class="fa-duotone fa-sitemap"></i> Lokasi Kantor Desa</a>
                </div>
            </div>
        </li>
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-informasi-desa">TRANSPARANSI KEUANGAN</a>
            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="nav-informasi-dese">
                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                    <a class="dropdown-item link-600 fw-medium" href=""><i class="fa-sharp fa-solid fa-bullseye-arrow"></i> Visi & Misi Desa</a>
                    <a class="dropdown-item link-600 fw-medium" href=""><i class="fa-duotone fa-sitemap"></i> Pemerintah Desa</a>
                </div>
            </div>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('transparansi-keuangan') ? 'bg-success text-white text-center' : '' }}" href="{{ route('transparansi-keuangan') }}">TRANSPARANSI KEUANGAN</a>
        </li>
    @endif




</ul>
