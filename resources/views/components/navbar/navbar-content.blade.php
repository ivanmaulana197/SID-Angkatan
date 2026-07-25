<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon">
            <span class="toggle-line"></span>
        </span>
    </button>
    @include('components.navbar.NavbarTopLeft.logo-app')
    @include('components.navbar.NavbarTopLeft.searchbar')
    @include('components.navbar.NavbarTopRight.navbar-top-right')
</nav>
<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;" data-move-target="#navbarVerticalNav" data-navbar-top="combo">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
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
<script>
    var navbarPosition = localStorage.getItem('navbarPosition');
    var navbarVertical = document.querySelector('.navbar-vertical');
    var navbarTopVertical = document.querySelector('.content .navbar-top');
    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

    @if (!request()->is('admin*'))
        navbarPosition = navbarPosition === 'double-top' ? 'double-top' : 'top';
    @else
        
        navbarPosition = localStorage.getItem('navbarPosition');
    @endif

    if (localStorage.getItem('navbarPosition') === 'double-top') {
        document.documentElement.classList.toggle('double-top-nav-layout');
    }
    if (navbarPosition === 'top') {
        navbarTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTopCombo.remove(navbarTopCombo);
        navbarDoubleTop.remove(navbarDoubleTop);
    } else if (navbarPosition === 'combo') {
        navbarVertical.removeAttribute('style');
        navbarTopCombo.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarTopVertical.remove(navbarTopVertical);
        navbarDoubleTop.remove(navbarDoubleTop);
    } else if (navbarPosition === 'double-top') {
        navbarDoubleTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTop.remove(navbarTop);
        navbarTopCombo.remove(navbarTopCombo);
    } else {
        navbarVertical.removeAttribute('style');
        navbarTopVertical.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarDoubleTop.remove(navbarDoubleTop);
        navbarTopCombo.remove(navbarTopCombo);
    }
</script>