@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Data Lembaga {{ $lembaga->nama }} Desa</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lembaga') }}">Lembaga Desa</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Data Lembaga {{ $lembaga->nama }} Desa</li>
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
        <div class="card-header">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('admin.lembaga') }}" class="btn btn-sm btn-falcon-default"><i class="fa-duotone fa-square-caret-left"></i> ke Daftar Lembaga</a>
                    <a href="{{ route('admin.lembaga.edit', $lembaga->slug) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Lembaga</a>
                    {{-- <form action="{{ route('admin.kependudukan.delete', $penduduk->id) }}" class="d-inline" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Hapus Biodata</button>
                    </form> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <h5>Rincian Lembaga</h5>
                </div>
                <div class="col-12 text-center">
                    <img src="{{ $lembaga->logo }}" alt="logo">
                </div>
                <div class="col-12">
                    <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden">
                            <tr>
                                <td>Nama Lembaga</td>
                                <td>:</td>
                                <td><span><strong>{{ $lembaga->nama }}</strong></span></td>
                            </tr>

                            <tr>
                                <td>Ketua Lembaga</td>
                                <td>:</td>
                                <td>{{ $lembaga->ketuaLembaga->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{!! $lembaga->deskripsi !!}</td>
                            </tr>

                        </table>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <h5>Anggota Lembaga</h5>
                </div>
                <div class="col-12">
                    <div id="tableExample3" data-list='{"valueNames":["username","nama-lengkap","role"],"page":5,"pagination":true}'>
                        <div class="row justify-content-between g-0">
                            <div class="col-auto">
                                <a href="{{ route('admin.lembaga.anggota.create',$lembaga->slug) }}" class="btn btn-sm btn-primary"> <i class="fa-duotone fa-hexagon-plus"></i> anggota</a>
                            </div>
                            <div class="col-auto col mb-3">
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
                                        <th>Aksi</th>
                                        <th style="width: 100px">Foto</th>
                                        <th class="sort" data-sort="nik" style="width: 100px">NIK</th>
                                        <th class="sort" data-sort="nama">Nama</th>
                                        <th class="sort" data-sort="tgl-lahir" style="width: 100px">Tgl. Lahir</th>
                                        <th class="sort" data-sort="jk" style="width: 100px">Jenis Kelamin</th>
                                        <th class="sort" data-sort="jabatan" style="width: 100px">jabatan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @forelse ($lembaga->anggotaLembaga as $anggota)
                                        <tr>
                                            <td>
                                                <a class="btn btn-sm btn-warning mb-2" href="{{ route('admin.lembaga.anggota.edit', [$lembaga->slug,$anggota->id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form action="{{ route('admin.lembaga.anggota.delete', [$lembaga->slug,$anggota->id]) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                                </form>
                                                
                                                
                                            </td>
                                            <td>
                                                <img style="width: 100px" src="{{ $anggota->foto }}" alt="">
                                            </td>
                                            <td class="nik">{{ $anggota->anggota->NIK }}</td>
                                            <td class="nama">{{ $anggota->anggota->nama }}</td>
                                            <td class="tgl-lahir">{{ \App\Helpers\DateHelpers::tgl_indo($anggota->anggota->tanggalLahir) ?? '-' }}</td>
                                            <td class="jk">{{ $anggota->anggota->jenisKelamin }}</td>
                                            <td class="jabatan">{{ $anggota->jabatan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">Tidak ada data yang tersedia.</td>
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
        </div>
    </div>
@endsection
