@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Kependudukan</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Kependudukan</li>
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
    <div class="card mb-3">
        <div class="card-body">
            <div id="tableExample3" data-list='{"valueNames":["nik","nama","no-kk","ayah","ibu","alamat","dusun","rw","rt","pekerjaan"],"page":5,"pagination":true}'>
                <h3 class="mb-3">Data Kependudukan</h3>
                <div class="row justify-content-between g-0">
                    <div class="row">

                        <div class="col-auto col-sm-5 mb-2">
                            <a href="{{ route('admin.kependudukan.create') }}" class="btn btn-sm btn-success mb-1"> Tambah Penduduk</a>

                            <button type="button" class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Import
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="post" action="{{ route('admin.kependududkan.import') }}" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                            </div>
                                            <div class="modal-body">

                                                {{ csrf_field() }}

                                                <label>Pilih file excel</label>
                                                <div class="form-group">
                                                    <input class="form-control" type="file" name="file" required="required">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto col-sm-7 mb-3">
                            <form>
                                <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                                    <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--1 mb-0">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th>Aksi</th>
                                <th style="width: 100px">Foto</th>
                                <th class="sort" data-sort="nik">NIK</th>
                                <th class="sort" data-sort="nama">Nama</th>
                                <th class="sort" data-sort="no-kk">No. KK</th>
                                <th class="sort" data-sort="ayah">Nama Ayah</th>
                                <th class="sort" data-sort="ibu">Nama Ibu</th>
                                <th class="sort" data-sort="alamat" style="width: 100px">Alamat</th>
                                <th class="sort" data-sort="dusun" style="width: 100px">Dusun</th>
                                <th class="sort" data-sort="rw" style="width: 100px">RW</th>
                                <th class="sort" data-sort="rt" style="width: 100px">RT</th>
                                <th class="sort" data-sort="pekerjaan" style="width: 100px">Pekerjaan</th>
                                <th class="sort" data-sort="tgl-terdaftar" style="width: 100px">Tgl. Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($penduduk as $penduduk)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">Lihat</button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('admin.kependudukan.show', $penduduk->id) }}">Lihat</a>
                                                <a class="dropdown-item" href="{{ route('admin.kependudukan.edit', $penduduk->id) }}">Edit</a>
                                                <form action="{{ route('admin.kependudukan.delete', $penduduk->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Hapus</button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('admin.kependudukan.dokumen', $penduduk->id) }}">Lihat Dokumen</a>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="post1" href="{{ $penduduk->foto }}" data-gallery="gallery-{{ $penduduk->id }}">
                                            <img style="width: 100px" src="{{ $penduduk->foto }}" alt="">
                                        </a>
                                    </td>
                                    <td class="nik">{{ $penduduk->NIK }}</td>
                                    <td class="nama">{{ $penduduk->nama }}</td>
                                    <td class="no-kk">{{ $penduduk->no_kk->no_kk ?? '-' }}</td>
                                    <td class="ayah">{{ $penduduk->nama_ayah ?? '-' }}</td>
                                    <td class="ibu">{{ $penduduk->nama_ibu ?? '-' }}</td>
                                    <td class="alamat">{{ $penduduk->alamat_sekarang ?? '-' }}</td>
                                    <td class="dusun">{{ $penduduk->dusun->nama ?? '-' }}</td>
                                    <td class="rw">{{ $penduduk->rw->rw ?? '-' }}</td>
                                    <td class="rt">{{ $penduduk->rt->rt ?? '-' }}</td>
                                    <td class="pekerjaan">{{ $penduduk->pekerjaan->nama ?? '-' }}</td>
                                    <td class="tgl-daftar">{{ \App\Helpers\DateHelpers::tgl_indo($penduduk->created_at) ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="13">Tidak ada data yang tersedia.</td>
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
