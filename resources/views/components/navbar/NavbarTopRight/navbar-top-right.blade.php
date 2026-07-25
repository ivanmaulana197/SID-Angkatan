<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
    @include('components.navbar.NavbarTopRight.switch-theme')
    @if (auth()->check())

        @include('components.navbar.NavbarTopRight.dropdown-profile-admin')
    @elseif (auth('penduduk_layanan_mandiri')->check())
       @include('components.navbar.NavbarTopRight.dropdown-profile-layanan-mandiri')
    @else
        {{-- <li class="nav-item">
            <a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
        </li>
        @push('modal')
            @include('components.Auth.modal-register')
        @endpush --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle pe-0 ps-2" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="login">Login</a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="login">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <a class="dropdown-item" href="{{ route('login') }}">Admin</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('layanan-mandiri.login') }}">Layanan Mandiri</a>
                </div>
            </div>

        </li>
    @endauth

</ul>
