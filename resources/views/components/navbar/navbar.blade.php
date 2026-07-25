{{-- if you have new page you can edit in 2 file:
'components.navbar.NavbarTopLeft.navbar-admin-vertical'
and
'components.navbar.NavbarTopLeft.navbar-user-top-left' --}}

<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" data-double-top-nav="data-double-top-nav" style="display: none;">
    <div class="w-100">
        <div class="d-flex flex-between-center">
            <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDoubleTop" aria-controls="navbarDoubleTop" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line"></span>
                </span>
            </button>
            @include('components.navbar.NavbarTopLeft.logo-app')
            @include('components.navbar.NavbarTopLeft.searchbar')
            @include('components.navbar.NavbarTopRight.navbar-top-right')

        </div>
        <hr class="my-2 d-none d-lg-block">
        <div class="collapse navbar-collapse scrollbar py-lg-2" id="navbarDoubleTop">
            @include('components.navbar.NavbarTopLeft.navbar-user-top-left')
        </div>
    </div>
</nav>
<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line"></span>
                </span>
            </button>
        </div>

        <div class="navbar-brand">
            <a href="{{ route('home') }}" class="d-flex align-items-center">
                <img class="me-2" src="{{ $myData['desa']->logo }}" alt="" width="40">
                <div class="d-flex flex-column justify-content-center" style="margin-top: 20px">
                    <span class="font-sans-serif text-success" style="font-size: 16px;">Desa {{ $myData['desa']->nama }}</span>
                    <p class="text-500 fs--2">Kecamatan {{ $myData['desa']->kecamatan }}</p>
                </div>

            </a>
        </div>

    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            @include('components.navbar.NavbarTopLeft.navbar-admin-vertical')
        </div>
    </div>
</nav>
<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon">
            <span class="toggle-line"></span>
        </span>
    </button>
    @include('components.navbar.NavbarTopLeft.logo-app')
    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
        @include('components.navbar.NavbarTopLeft.navbar-user-top-left')
    </div>
    @include('components.navbar.NavbarTopRight.navbar-top-right')
</nav>
