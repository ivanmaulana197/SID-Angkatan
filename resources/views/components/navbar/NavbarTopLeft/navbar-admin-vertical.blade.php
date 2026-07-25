<ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}" aria-expanded="true" aria-controls="dashboard">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span></div>
        </a>

    </li>
    <li class="nav-item">
        <!-- label-->
        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">App</div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider">
            </div>
        </div>

        
        {{-- <a class="nav-link" href="{{ route('admin.surat.permohonan-surat') }}" aria-expanded="true" aria-controls="berita">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Permohonan Surat</span></div>
        </a> --}}
        <a class="nav-link dropdown-indicator " href="#infoDesa" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="data">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span class="fa-solid fa-square-info"></span>
                </span>
                <span class="nav-link-text ps-1">Info Desa</span>
            </div>
        </a>
        <ul class="nav collapse @if(request()->is('admin/wilayah-administratif*','admin/lembaga*','admin/pemerintahan-desa*')) show @endif" id="infoDesa">
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/wilayah-administratif*')) active @endif" href="{{ route('admin.dusun') }}" aria-expanded="true" aria-controls="berita">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fa-duotone fa-earth-americas"></i>
                        </span><span class="nav-link-text ps-1">Wilayah Administratif</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/lembaga*')) active @endif" href="{{ route('admin.lembaga') }}" role="button">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-regular fa-building-columns"></i></span><span class="nav-link-text ps-1">Lembaga</span></div>
                </a>
            </li>
            <div class="nav-item">
                <a class="nav-link dropdown-indicator " href="#pemerintahanDesa" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="data">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fa-solid fa-house-building"></i>
                        </span>
                        <span class="nav-link-text ps-1">Pemerintahan Desa</span>
                    </div>
                </a>
                <ul class="nav collapse @if(request()->is('admin/pemerintahan-desa*')) show @endif" id="pemerintahanDesa">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/pemerintahan-desa/visi-misi*')) active @endif" href="{{ route('admin.visi-misi') }}" aria-expanded="true" aria-controls="berita">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-sharp fa-solid fa-bullseye-arrow"></i></span><span class="nav-link-text ps-1">Visi dan Misi</span></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/pemerintahan-desa/sejarah-desa*')) active @endif" href="{{ route('admin.sejarah-desa') }}" aria-expanded="true" aria-controls="berita">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-duotone fa-monument"></i></span><span class="nav-link-text ps-1">Sejarah Desa</span></div>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/pemerintahan-desa/pemerintah-desa*')) active @endif" href="{{ route('admin.pemerintah-desa') }}" aria-expanded="true" aria-controls="berita">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-list-tree"></i></span><span class="nav-link-text ps-1">Pemerintah Desa</span></div>
                        </a>
                    </li>
        
                </ul>
            </div>
            

        </ul>

        

        <a class="nav-link dropdown-indicator" href="#kependudukan" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="data master">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <i class="fa-solid fa-people-group"></i>
                </span><span class="nav-link-text ps-1">Kependudukan</span></div>
        </a>
        <ul class="nav collapse @if(request()->is('admin/keluarga*','admin/kependudukan*')) show @endif" id="kependudukan">

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/kependudukan*')) active @endif" href="{{ route('admin.kependudukan') }}" role="button">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-people-group"></i></span><span class="nav-link-text ps-1">Kependudukan</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/keluarga*')) active @endif" href="{{ route('admin.keluarga') }}" role="button">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-regular fa-people"></i></span><span class="nav-link-text ps-1">Keluarga</span></div>
                </a>
            </li>
        </ul>

        <a class="nav-link dropdown-indicator" href="#layananSurat" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="data surat">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <i class="fa-duotone fa-envelope-open-text"></i>
                </span><span class="nav-link-text ps-1">Layanan Surat</span></div>
        </a>
        <ul class="nav collapse @if(request()->is('admin/surat*')) show @endif" id="layananSurat">

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/surat','admin/surat/*/tinjau','admin/surat/*/upload-file')) active @endif" href="{{ route('admin.surat') }}" aria-expanded="true" aria-controls="berita">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-duotone fa-envelope-open-text"></i></span><span class="nav-link-text ps-1">Layanan Surat</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/surat/jenis-surat*')) active @endif" href="{{ route('admin.surat.jenis-surat') }}" aria-expanded="true" aria-controls="berita">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-regular fa-envelopes-bulk"></i></span><span class="nav-link-text ps-1">Jenis Surat</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/surat/persyaratan-surat*')) active @endif" href="{{ route('admin.surat.persyaratan-surat') }}" aria-expanded="true" aria-controls="berita">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-sharp fa-solid fa-file-contract"></i></span><span class="nav-link-text ps-1">Dokumen Persyaratan Surat</span></div>
                </a>
            </li>

        </ul>
        
        <a class="nav-link @if(request()->is('admin/layanan-mandiri*')) active @endif" href="{{ route('admin.layanan-mandiri') }}" aria-expanded="true" aria-controls="berita">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-box-taped"></i></span><span class="nav-link-text ps-1">Layanan Mandiri</span></div>
        </a>
        <a class="nav-link @if(request()->is('admin/transparansi-anggaran*')) active @endif" href="{{ route('admin.transparansi-anggaran') }}" aria-expanded="true" aria-controls="berita">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-money-check-dollar-pen"></i></span><span class="nav-link-text ps-1">Transparansi Anggaran</span></div>
        </a>
        
       
        <a class="nav-link dropdown-indicator" href="#media" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="data media">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <i class="fa-duotone fa-typewriter"></i>    
                </span><span class="nav-link-text ps-1">Media</span></div>
        </a>
        <ul class="nav collapse @if(request()->is('admin/berita*','admin/informasi-desa*')) show @endif" id="media">

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/berita*')) active @endif" href="{{ route('admin.berita') }}" aria-expanded="true" aria-controls="berita">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-newspaper"></i></span><span class="nav-link-text ps-1">Berita</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/informasi-desa*')) active @endif" href="{{ route('admin.informasi-desa') }}" aria-expanded="true" aria-controls="berita">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-memo-circle-info"></i></span><span class="nav-link-text ps-1">Informasi Desa</span></div>
                </a>
                
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/agenda*')) active @endif" href="{{ route('admin.agenda') }}" aria-expanded="true" aria-controls="Agenda">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-duotone fa-calendar-days"></i></span><span class="nav-link-text ps-1">Agenda Desa</span></div>
                </a>
                
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/galeri*')) active @endif" href="{{ route('admin.galeri') }}" aria-expanded="true" aria-controls="galero">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-duotone fa-calendar-days"></i></span><span class="nav-link-text ps-1">Galeri Desa</span></div>
                </a>
                
            </li>
        </ul>
        
        
    </li>
    @role('admin')
        <li class="nav-item">
            <!-- label-->
            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                <div class="col-auto navbar-vertical-label">Pengaturan</div>
                <div class="col ps-0">
                    <hr class="mb-0 navbar-vertical-divider">
                </div>
            </div>

            <a class="nav-link @if(request()->is('admin/settings/users*')) active @endif" href="{{ route('admin.setting.user') }}" aria-expanded="true" aria-controls="berita">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </span>
                    <span class="nav-link-text ps-1">User</span>
                </div>
            </a>
            <a class="nav-link @if(request()->is('admin/settings/pengaturan-desa*')) active @endif" href="{{ route('admin.setting.desa') }}" aria-expanded="true" aria-controls="berita">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-duotone fa-house-turret"></i></span><span class="nav-link-text ps-1">Desa</span></div>
            </a>

        </li>
    @endrole
</ul>
