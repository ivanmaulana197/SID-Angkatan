@extends('layouts.base')

@section('layout')
    @include('components.navbar.navbar')
    <div class="content">
        @include('components.navbar.navbar-content')
        @yield('content')
        @if (Request::is('admin*'))
            @include('components.footer.footer-admin')
        @endif
        @stack('modal')
    </div>
@endsection
