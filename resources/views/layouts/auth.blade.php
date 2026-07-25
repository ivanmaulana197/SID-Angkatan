@extends('layouts.base')

@section('layout')
<div class="row flex-center min-vh-100 py-4">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4 col-xxl-6">
        @yield('content')
    </div>
</div>
@endsection