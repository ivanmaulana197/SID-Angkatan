@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tinjau Permohonan Surat</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.surat') }}">Permohonan Surat</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permohonan Surat</li>
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
                    <a href="{{ route('admin.surat') }}" class="btn btn-sm btn-falcon-default">Kembali ke Permohonan Surat</a>
                </div>
                <h5>Biodata Pemohon</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 d-flex flex-center">
                    <img src="{{ $penduduk->foto }}" alt="foto penduduk" style="width: 200px">
                </div>
                <div class="col-md-8">
                    <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden">
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
                                <td>Nomor Kartu Keluarga</td>
                                <td>:</td>
                                <td><span><strong>{{ $penduduk->no_kk->no_kk ?? '-' }}</strong></span></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $penduduk->jenisKelamin }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5>Permohonan Surat</h5>
                    <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden">
                            <tr>
                                <td width="200">Nama Surat</td>
                                <td width="30">:</td>
                                <td><span><strong>{{ $permohonanSurat->jenisSurat->nama }}</strong></span></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td><span>{{ $permohonanSurat->keterangan }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 d-grid mb-2">

                            <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#tolak">Tolak Verifikasi</button>
                            @error('pesan_gagal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="modal fade" id="tolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Permohonan Surat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.surat.tolak-verifikasi', $permohonanSurat->id) }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                <textarea class="form-control" id="pesanGagal" rows="3" placeholder="Pesan gagal" name="pesan_gagal"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <form action="{{ route('admin.surat.verifikasi', $permohonanSurat->id) }}" method="post" class="d-inline  d-grid">
                                @csrf
                                <button class="btn btn-sm btn-success " type="submit">Verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Kelengkapan Dokumen</h5>
                    <div class="table-responsive scrollbar mb-2">
                        <table class="table table-bordered table-striped fs--1 mb-0">
                            <thead class="bg-200 text-900">
                                <tr>
                                    <th width="30">No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Kelengkapan Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permohonanSurat->dokumenPenduduk as $dokumen)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dokumen->jenisDokumen->nama }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#myModal{{ $dokumen->id }}">
                                                Cek Dokumen
                                            </button>
                                        </td>


                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal{{ $dokumen->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tampilkan Dokumen</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ $dokumen->file }}" alt="Gambar" class="img-fluid">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">


                </div>
            </div>
        </div>
    </div>
@endsection
