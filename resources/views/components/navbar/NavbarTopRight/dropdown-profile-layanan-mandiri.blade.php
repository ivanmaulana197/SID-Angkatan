<li class="nav-item dropdown">
    <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-xl">
            <img class="rounded-circle" src="{{ auth('penduduk_layanan_mandiri')->user()->penduduk->foto }}" alt="">
        </div>
    </a>
    <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
        <div class="bg-white dark__bg-1000 rounded-2 py-2">
            <a class="dropdown-item" href="{{ route('layanan-mandiri') }}">Layanan Mandiri</a>
            <a class="dropdown-item" href="{{ route('layanan-mandiri.profile') }}">Profile</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">logout</button>
            </form>


        </div>
    </div>
</li>
