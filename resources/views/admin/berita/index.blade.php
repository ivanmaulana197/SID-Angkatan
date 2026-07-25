@extends('layouts.main')
@push('css')
    <style>
        .tes {
            border-radius: 30px;
            max-height: 200px;
            max-width: 500px;
        }

        .img-tes {
            object-fit: cover;
            width: 100%;
            height: 200px;
        }

        @media screen and (max-width: 768px) {
            .tes {
                border-radius: 20px;
                height: 100px;
            }

            .img-tes {
                height: 100px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Berita</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
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

    @include('admin.berita.kategori.index')



    <div class="card mb-3">
        <div class="card-body">
            <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                <h3 class="mb-3">Data Berita</h3>
                <div class="row justify-content-between g-0">
                    <div class="col-auto col-sm-5 mb-2">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-sm btn-success">+ Tambah</a>
                    </div>
                    <div class="col-auto col-sm-5 mb-3">
                        <form>
                            <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                                <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--1 mb-0">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th data-sort="aksi">Aksi</th>
                                <th class="sort" data-sort="judul">Judul</th>
                                <th class="sort" data-sort="kategori" style="width: 100px">Kategori</th>
                                <th class="sort" data-sort="Dilihat">Dilihat</th>
                                <th class="sort" data-sort="Status">Status</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($berita as $berita)
                                <tr>
                                    <td class="aksi">
                                        <a href="{{ route('admin.berita.show', $berita->slug) }}" class="btn btn-sm btn-primary mb-2">Lihat</a>
                                        <a href="{{ route('admin.berita.edit', $berita->slug) }}" class="btn btn-sm btn-warning mb-2">Edit</a>
                                        <a href="{{ route('admin.berita.gambar', $berita->slug) }}" class="btn btn-sm btn-success mb-2"> Kelola Gambar</a>
                                        @include('admin.berita.delete')
                                    </td>
                                    <td class="judul">{{ $berita->judul }}</td>
                                    <td class="kategori">{{ $berita->kategori->nama }}</td>
                                    <td class="dilihat">{{ $berita->diakses }}</td>
                                    <td class="dilihat">
                                        @if ($berita->status == 'DRAFT')
                                            <span class="badge badge-subtle-warning">{{ $berita->status }}</span>
                                        @elseif ($berita->status == 'PUBLISHED')
                                            <span class="badge badge-subtle-success">{{ $berita->status }}</span>
                                        @else
                                            <span class="badge badge-subtle-primary">{{ $berita->status }}</span>
                                        @endif
                                    </td>
                                    <td class="gambar" style="max-width:300px">
                                        @include('admin.berita.components.carousal')
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
