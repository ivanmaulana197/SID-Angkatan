@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Lembaga Desa</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Lembaga Desa</li>
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
            <div id="tableExample3" data-list='{"valueNames":["username","nama-lengkap","role"],"page":5,"pagination":true}'>
                <h3 class="mb-3">Data Lembaga Desa</h3>
                <div class="row justify-content-between g-0">
                    <div class="row">

                        <div class="col-auto col-sm-5 mb-2">
                            <a href="{{ route('admin.lembaga.create') }}" class="btn btn-sm btn-success"><i class="fa-duotone fa-hexagon-plus"></i> Lembaga</a>
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
                                <th class="sort" data-sort="logo">Logo</th>
                                <th class="sort" data-sort="nama">Nama Lembaga</th>
                                <th class="sort" data-sort="ketua-lembaga">Ketua Lembaga</th>
                                <th class="sort" data-sort="jumlah_anggota">Jumlah Anggota</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($lembaga as $lembaga)
                                <tr>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.lembaga.show', $lembaga->slug) }}"><i class="fa-solid fa-sunglasses"></i></a>

                                        <a class="btn btn-sm btn-warning" href="{{ route('admin.lembaga.edit', $lembaga->slug) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <form action="{{ route('admin.lembaga.delete', $lembaga->slug) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>


                                    </td>
                                    <td class="logo">
                                        <img src="{{ $lembaga->logo }}" alt="logo lembaga"  style="width: 150px">
                                    </td>
                                    <td class="nama">{{ $lembaga->nama }}</td>
                                    <td class="ketua-lembaga">{{ $lembaga->ketuaLembaga->nama ?? '-' }}</td>
                                    <td class="jumlah_anggota">{{ count($lembaga->anggotaLembaga) }}</td>

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
