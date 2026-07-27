@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Profile User</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active" aria-current="page">Profile User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('success') }}
        </div>
    @endif
    @if (old('foto'))
        @dd(old('foto'))
    @endif
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-4 mb-3">
                <div class="card align-items-center">
                    <div class="card-header">
                        <h5 class="fs-1 ">Foto Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="avatar avatar-5xl shadow-sm img-thumbnail rounded-circle">
                            <div class="h-100 w-100 rounded-circle overflow-hidden position-relative">
                                <img src="{{ config('url').'/'.old('foto', $user->foto) }}" id="img-preview" width="200" alt="profile" data-dz-thumbnail="data-dz-thumbnail">
                                <input class="d-none" id="profile-image" type="file" name="foto">
                                <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image">
                                    <span class="bg-holder overlay overlay-0"></span>
                                    <span class="z-1 text-white dark__text-white text-center fs--1">
                                        <span class="fas fa-camera"></span>
                                        <span class="d-block">Update</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button onclick="hapus()" class="btn btn-sm btn-danger mb-3">Hapus</button>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Profile</div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="mb-2">
                            <label class="form-label" for="title">Nama Lengkap</label>
                            <input class="form-control  @error('fullName') is-invalid @enderror" type="text" name="fullName" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', $user->fullName) }}">
                            <small class="text-danger">
                                @error('fullName')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="title">Username</label>
                            <input class="form-control  @error('name') is-invalid @enderror" type="text" name="name" placeholder="Masukkan Username" value="{{ old('name', $user->name) }}">
                            <small class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success me-2" type="submit">Simpan</button>
                        <a href="{{ route('admin.profile.ubah-password') }}" class="btn btn-sm btn-primary">Ubah Password</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var foto = "{{ config('url').'/'.old('foto', $user->foto) }}";
            if (foto) {
                $('#img-preview').attr('src', foto);
            }
        });

        $('#profile-image').change(function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            // Ketika file telah selesai di-load
            reader.onload = function(e) {
                // Ubah href dari a tag dengan id preview_img
                // Ubah src dari img tag yang menjadi child dari a tag tersebut
                $('#img-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        function hapus() {
            // Hapus gambar yang sudah ada
            $('#img-preview').attr('src', '{{ asset('img/profile-default.png') }}');

            // Hapus nilai input file
            $('#profile-image').val('');

            // Tambahkan input tersembunyi dengan nilai gambar default
            $('<input>').attr({
                type: 'hidden',
                name: 'default_image',
                value: '{{ asset('img/profile-default.png') }}'
            }).appendTo('form');
            $('form').submit();
        }
    </script>
@endpush
