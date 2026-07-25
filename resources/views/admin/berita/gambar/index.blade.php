@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Kelola Gambar Berita</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.berita') }}">Berita</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.berita.edit', $berita->slug) }}">Edit Berita</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kelola Gambar Berita: <span class="fw-bolder"> {{ $berita->judul }} </span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-warning" style="margin-top:30px;">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-body">
            <div id="tableExample3" data-list='{"valueNames":["gambar",],"page":5,"pagination":true}'>
                <h4 class="mb-3">Data Gambar Dari Berita : {{ $berita->judul }}</h4>
                <form action="{{ route('admin.berita.gambar.store', $berita->slug) }}" method="post" id="formAddGambar" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between g-0">
                        <div class="col-lg-4 col-md-5 col-sm-3 mb-2">
                            <a href="{{ route('admin.berita') }}" class="btn btn-falcon-default">Kembali</a>
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-9 mb-3">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 mb-2">
                                    <button type="submit" id="btnTambahGambar" class="btn btn-sm btn-success d-inline">+ Tambah</button>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    <input class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar" id="gambar">
                                    <small class="text-danger">
                                        @error('gambar')
                                            {{ $message }}
                                        @enderror
                                    </small>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--1 mb-0">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" style="width:20px" data-sort="nomor">No.</th>
                                <th>Gambar</th>
                                <th data-sort="aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($berita->images as $i=>$gambar)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <a class="post1" href="{{ $gambar->url }}" data-gallery="gallery-1">
                                            <img class="d-block" width="300px" src="{{ $gambar->url }}" alt="Slide {{ $i + 1 }}" />
                                        </a>
                                    </td>

                                    <td class="aksi">
                                        {{-- <a href="/" class="btn btn-sm btn-warning">Edit</a> --}}
                                        @include('admin.berita.gambar.delete')
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Tidak ada data yang tersedia.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                    <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#gambar').change(){
            $('#formAddGambar').submit();
        }
    </script>
@endsection
