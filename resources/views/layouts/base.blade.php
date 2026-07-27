<!DOCTYPE html>
<html data-bs-theme="light" lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="turbolinks-cache-control" content="no-cache">

    <title>Laravel Livewire</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png') }}" />
    <meta name="theme-color" content="#ffffff">
    {{-- <script src="https://cdn.tiny.cloud/1/4f9hl700k0g86tzzup25pfvd5ph6blfn145unbc3eny7uf8a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link href="{{ asset('/vendors/glightbox/glightbox.min.css') }}" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css"> --}}
    <script src="https://kit.fontawesome.com/a2dc60a181.js" crossorigin="anonymous"></script>
    <link href="https://code.highcharts.com/css/highcharts.css" rel="stylesheet">
    <link href="{{ asset('/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    @stack('css')
</head>

<body>

    <main class="main pb-6 pb-lg-0" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>

            @yield('layout')
         

        </div>

        @if (!Request::is('admin*', 'login', 'login-layanan-mandiri','layanan-mandiri*'))
            @include('components.footer.footer-guest')
        @endif
        @include('components.customize-button')
    </main>

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    
    <script src="{{ asset('vendors/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('/vendors/is/is.min.js') }}"></script>
    
    <script src="{{ asset('/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/vendors/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('/vendors/chart/chart.min.js') }}"></script>
    <script src="{{ asset('/assets/js/theme.js') }}"></script>
    <script>
        document.documentElement.style.setProperty('--falcon-primary', '#50C878');
    </script>
    @stack('js')

</body>

</html>
