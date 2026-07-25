@extends('layouts.main')

@section('content')
    @include('layanan-mandiri.component.header')

    <div class="row">
        <div class="col-md-3 col-sm-5 mb-3">
            @include('layanan-mandiri.component.card-profile')
        </div>
        <div class="col-md-9 col-sm-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Profile Penduduk</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden">
                            <tr class="table-primary">
                                <th colspan="3"><strong>DATA UMUM</strong></th>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><span><strong>{{ $penduduk->nama }}</strong></span></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><span><strong>{{ $penduduk->NIK }}</strong></span></td>
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
                                <th colspan="3"><strong>DATA ALAMAT</strong></th>
                            </tr>
                            <tr>
                                <td>Dusun</td>
                                <td>:</td>
                                <td>{{ $penduduk->dusun->nama }}</td>
                            </tr>
                            <tr>
                                <td>RT / RW</td>
                                <td>:</td>
                                <td>{{ $penduduk->rt->rt }} / {{ $penduduk->rw->rw }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $penduduk->alamat_sekarang }}</td>
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
        </div>
    </div>
@endsection