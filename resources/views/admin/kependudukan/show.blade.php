@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Biodata Penduduk</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.kependudukan') }}">Kependudukan</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Biodata Penduduk</li>
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
                    <a href="{{ route('admin.kependudukan') }}" class="btn btn-sm btn-falcon-default">Kembali ke Daftar Penduduk</a>
                    <a href="{{ route('admin.kependudukan.edit', $penduduk->id) }}" class="btn btn-sm btn-warning">Ubah Biodata</a>
                    <form action="{{ route('admin.kependudukan.delete', $penduduk->id) }}" class="d-inline" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Hapus Biodata</button>
                    </form>
                </div>
                <h5>Biodata Penduduk: {{ $penduduk->nama }} (NIK: {{ $penduduk->NIK }})</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img src="{{ $penduduk->foto }}" alt="foto penduduk" style="width: 200px">
            </div>
            <div class="table-responsive scrollbar">
                <table class="table table-striped overflow-hidden">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><span><strong>{{ $penduduk->nama }}</strong></span></td>
                    </tr>
                    <tr>
                        <td width="300">Status</td>
                        <td width="1">:</td>
                        <td><span><strong>{{ $penduduk->kondisi->nama }}</strong></span></td>
                    </tr>
                    <tr>
                        <td>Nomor Kartu Keluarga</td>
                        <td>:</td>
                        <td><span><strong>{{ $penduduk->no_kk->no_kk ?? '-' }}</strong></span></td>
                    </tr>
                    <tr>
                        <td>Hubungan Dalam Keluarga</td>
                        <td>:</td>
                        <td>{{ $penduduk->hubungan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $penduduk->jenisKelamin }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td>{{ $penduduk->agama->nama }}</td>
                    </tr>
                    <tr>
                        <td>Status Penduduk</td>
                        <td>:</td>
                        <td>{{ $penduduk->statusPenduduk }}</td>
                    </tr>
                    <tr class="table-primary">
                        <th colspan="3"><strong>DATA KELAHIRAN</strong></th>
                    </tr>
                    <tr>
                        <td>Akta Kelahiran</td>
                        <td>:</td>
                        <td>{{ $penduduk->no_akta_kelahiran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tempat / Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $penduduk->tempatLahir }}, {{ \App\Helpers\DateHelpers::tgl_indo($penduduk->tanggalLahir) ?? '-' }}</td>
                    </tr>
                    <tr class="table-primary">
                        <th colspan="3"><strong>DATA KESEHATAN</strong></th>
                    </tr>
                    <tr>
                        <td>Golongan Darah</td>
                        <td>:</td>
                        <td>{{ $penduduk->golonganDarah->nama }}</td>
                    </tr>
                    <tr>
                        <td>Kecacatan</td>
                        <td>:</td>
                        <td>{{ $penduduk->kecacatan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Riwayat Penyakit</td>
                        <td>:</td>
                        <td>{{ $penduduk->penyakit->nama }}</td>
                    </tr>
                    <tr class="table-primary">
                        <th colspan="3"><strong>STATUS PERKAWINAN</strong></th>
                    </tr>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>:</td>
                        <td>{{ $penduduk->statusKawin->nama ?? '-' }}</td>
                    </tr>
                    @if ($penduduk->statusKawin->id != 1)
                        <tr>
                            <td>Akta Perkawinan</td>
                            <td>:</td>
                            <td>{{ $penduduk->no_akta_perkawinan ?? '-' }}</td>
                        </tr>
                        @if ($penduduk->statusKawin->id == 3)
                            <tr>
                                <td>Akta Peceraian</td>
                                <td>:</td>
                                <td>{{ $penduduk->no_akta_perceraian ?? '-' }}</td>
                            </tr>
                        @endif
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
