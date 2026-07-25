@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Keluarga</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Keluarga</li>
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
            <div id="tableExample3" data-list='{"valueNames":["no-kk","nama","nik",
            "jumlah_anggota",
            "alamat",
            "dusun",
            "rw",
            "rt"],"page":10,"pagination":true}'>
                <h3 class="mb-3">Data Keluarga</h3>
                <div class="row justify-content-between g-0">
                    <div class="row">

                        <div class="col-auto col-sm-5 mb-2">
                            <div class="btn-group mb-2 mb-md-0">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tambah KK</button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.kependudukan.create') }}" class="dropdown-item"> Tambah Penduduk Masuk</a>
                                    <a href="{{ route('admin.keluarga.create') }}" class="dropdown-item"> Dari data penduduk</a>
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
                                <th style="width: 300px">Aksi</th>
                                <th class="sort" data-sort="no-kk">No. KK</th>
                                <th class="sort" data-sort="nama">Kepala Keluarga</th>
                                <th class="sort" data-sort="nik">NIK</th>
                                <th class="sort" data-sort="jumlah_anggota">Jumlah Anggota</th>
                                <th class="sort" data-sort="alamat" style="width: 100px">Alamat</th>
                                <th class="sort" data-sort="dusun" style="width: 100px">Dusun</th>
                                <th class="sort" data-sort="rw" style="width: 100px">RW</th>
                                <th class="sort" data-sort="rt" style="width: 100px">RT</th>
                                <th class="sort" data-sort="tgl-terdaftar" style="width: 100px">Tgl. Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($kk as $kk)
                                <tr>
                                    <td>
                                        <a class="btn btn-sm btn-primary mb-2" href="{{ route('admin.keluarga.show', $kk->id) }}">Lihat</a>
                                        @if ($kk->id_penduduk)
                                            <a class="btn btn-sm btn-warning mb-2" href="{{ route('admin.keluarga.edit', $kk->id) }}">Edit</a>
                                        @endif
                                        @if (count($kk->penduduk) == 0)
                                            <form action="{{ route('admin.keluarga.delete', $kk->id) }}" method="post" class="d-inline mb-2">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                            </form>
                                        @endif

                                    </td>
                                    <td class="no-kk">{{ $kk->no_kk }}</td>
                                    <td class="nama">{{ $kk->kepalaKeluarga->nama ?? '-' }}</td>
                                    <td class="nik">{{ $kk->kepalaKeluarga->NIK ?? '-' }}</td>
                                    <td class="jumlah_anggota">{{ count($kk->penduduk) }}</td>
                                    <td class="alamat">{{ $kk->kepalaKeluarga->alamat_sekarang ?? '-' }}</td>
                                    <td class="dusun">{{ $kk->kepalaKeluarga->dusun->nama ?? '-' }}</td>
                                    <td class="rw">{{ $kk->kepalaKeluarga->rw->rw ?? '-' }}</td>
                                    <td class="rt">{{ $kk->kepalaKeluarga->rt->rt ?? '-' }}</td>
                                    <td class="tgl-daftar">{{ \App\Helpers\DateHelpers::tgl_indo($kk->created_at) ?? '-' }}</td>

                                    {{-- <td>
                                        <img style="width: 100px" src="{{ $penduduk->foto }}" alt="">
                                    </td>
                                    <td class="nik">{{ $penduduk->NIK }}</td>
                                    <td class="ayah">{{ $penduduk->nama_ayah ?? '-' }}</td>
                                    <td class="ibu">{{ $penduduk->nama_ibu ?? '-' }}</td>
                                    <td class="rt">{{ $penduduk->pekerjaan->nama ?? '-' }}</td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="10">Tidak ada data yang tersedia.</td>
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
