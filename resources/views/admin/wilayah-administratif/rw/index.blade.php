@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Wilayah Administratif RW</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dusun') }}">Wilayah Administratif Dusun</a></li>
                            <li class="breadcrumb-item active" aria-current="page">RW dari Dusun: "{{ $dusun->nama }}"</li>
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
            <div id="tableExample3" data-list='{"valueNames":["rw","ketua-rw","jumlah-rt"],"page":5,"pagination":true}'>
                <h5 class="mb-3">Data Wilayah Administratif RW Dusun: "{{ $dusun->nama }}"</h5>
                <div class="row justify-content-between g-0">
                    <div class="col-auto col-sm-5 mb-2">

                        <a href="{{ route('admin.dusun') }}" class="btn btn-falcon-default">Kembali ke Dusun</a>
                        <a href="{{ route('admin.rw.create', $dusun->id) }}" class="btn btn-success">+ Tambah RW</a>
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
                                <th class="sort" data-sort="rw">RW</th>
                                <th class="sort" data-sort="ketua-rw">Ketua RW</th>
                                {{-- <th class="sort" data-sort="jumlah-rw" style="width: 30px">RW</th> --}}
                                <th class="sort" data-sort="jumlah-rt" style="width: 30px">RT</th>
                                <th class="sort" data-sort="jumlah-penduduk" style="width: 30px">Jumlah Penduduk</th>
                                <th data-sort="aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($rw as $rw)
                                <tr>
                                    <td class="rw">{{ $rw->rw }}</td>
                                    <td class="ketua-rw">{{ $rw->ketuaRW->nama ?? '-' }}</td>
                                    @php
                                        $jumlahPenduduk = App\Models\Penduduk::where('id_rw', $rw->id)->count();
                                    @endphp
                                    <td class="jumlah-rt">
                                        <a href="{{ route('admin.rt', [$dusun->id, $rw->id]) }}">
                                            {{ count($rw->rt) }}
                                        </a>
                                    </td>
                                    <td class="jumlah-penduduk">{{ $jumlahPenduduk }}</td>
                                    <td class="aksi">
                                        <a href="{{ route('admin.rw.edit', [$dusun->id, $rw->id]) }}" class="btn btn-sm btn-warning mb-2">Edit</a>

                                        @include('admin.wilayah-administratif.rw.delete')
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
