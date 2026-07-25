@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Daftar Anggota Keluarga</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.keluarga') }}">Keluarga</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Daftar Anggota Keluarga</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('admin.keluarga') }}" class="btn btn-sm btn-falcon-default">Kembali ke Daftar Keluarga</a>
                    <a href="{{ route('admin.keluarga.edit', $kk->id) }}" class="btn btn-sm btn-warning">Ubah Biodata</a>
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
                    <h5>Rincian Keluarga</h5>
                </div>
                <div class="col-12">

                    <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden">
                            <tr>
                                <td>Nomor Kartu Keluarga (KK)</td>
                                <td>:</td>
                                <td><span><strong>{{ $kk->no_kk }}</strong></span></td>
                            </tr>

                            <tr>
                                <td>Kepala Keluarga</td>
                                <td>:</td>
                                <td>{{ $kk->kepalaKeluarga->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $kk->kepalaKeluarga ? 'RT ' . $kk->kepalaKeluarga->rt->rt . ' / RW ' . $kk->kepalaKeluarga->rw->rw . ' - DUSUN ' . $kk->kepalaKeluarga->dusun->nama : '-' }}</td>
                            </tr>

                        </table>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <h5>Daftar Anggota Keluarga</h5>
                </div>
                <div class="col-12">
                    <div id="tableExample3" data-list='{"valueNames":["username","nama-lengkap","role"],"page":5,"pagination":true}'>
                        <div class="row justify-content-between g-0">
                            <div class="col-auto">
                                <a href="{{ route('admin.keluarga.penduduk.create',$kk->id) }}" class="btn btn-sm btn-primary"> tambah anggota</a>
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
                                        <th class="sort" data-sort="nik">NIK</th>
                                        <th class="sort" data-sort="nama">Nama</th>
                                        <th class="sort" data-sort="tgl-lahir" style="width: 100px">Tgl. Lahir</th>
                                        <th class="sort" data-sort="jk" style="width: 100px">Jenis Kelamin</th>
                                        <th class="sort" data-sort="hubungan" style="width: 100px">Hubungan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @forelse ($kk->penduduk as $penduduk)
                                        <tr>
                                            <td>
                                                <a class="btn btn-sm btn-warning mb-3" href="{{ route('admin.kependudukan.edit', $penduduk->id) }}">Edit</a>
                                                <form action="{{ route('admin.keluarga.penduduk.delete', [$kk->id,$penduduk->id]) }}" method="post" class="d-inline mb-3">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                                </form>
                                                
                                                {{-- <div class="btn-group">
                                                    <button class="btn btn-sm btn-primary dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">Lihat</button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('admin.kependudukan.edit', $penduduk->id) }}">Edit</a>
                                                        <form action="{{ route('admin.kependudukan.delete', $penduduk->id) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="dropdown-item" type="submit">Hapus</button>
                                                        </form>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <img style="width: 100px" src="{{ $penduduk->foto }}" alt="">
                                            </td>
                                            <td class="nik">{{ $penduduk->NIK }}</td>
                                            <td class="nama">{{ $penduduk->nama }}</td>
                                            <td class="tgl-lahir">{{ \App\Helpers\DateHelpers::tgl_indo($penduduk->tanggalLahir) ?? '-' }}</td>
                                            <td class="jk">{{ $penduduk->jenisKelamin }}</td>
                                            <td class="hubungan">{{ $penduduk->hubungan->nama }}</td>
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
