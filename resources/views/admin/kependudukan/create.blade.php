@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Penduduk</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.kependudukan') }}">Kependudukan</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Tambah Pendudukan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.kependudukan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-3 col-12 mb-3">
                <div class="card align-items-center">
                    <div class="card-header">
                        <h5 class="fs-1 ">Foto Penduduk</h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="mb-3">
                            <img id="preview_img" class="img-fluid rounded" src="{{ old('foto')?? asset('img/profile-default.png') }}" alt="" />
                        </div>
                        @error('foto')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                        <div class="mb-3" style="display:none">
                            <label for="file_input" class="form-label">Pilih File</label>
                            <input id="file_input" type="file" class="form-control" name="foto">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-primary d-block mx-auto" onclick="document.getElementById('file_input').click();">Unggah</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h5>Tambah Penduduk</h5>
                            <div class="col-12">
                                <a href="{{ route('admin.kependudukan') }}" class="btn btn-sm btn-falcon-default">Kembali ke Daftar Penduduk</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row mb-3">
                            {{-- data diri --}}
                            <div class="col-12 bg-300 pt-2 mb-2">
                                <h5 class="fw-semi-bold">Data Diri :</h5>
                            </div>
                            {{-- NIK --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="NIK">NIK</label>
                                <input class="form-control  @error('NIK') is-invalid @enderror" type="number" name="NIK" placeholder="Masukkan NIK" value="{{ old('NIK') }}" id="NIK">
                                @error('NIK')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- no kk --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="id_kk">Nomor KK</label>
                                <input class="form-control  @error('no_kk') is-invalid @enderror" type="number" name="no_kk" placeholder="Masukkan Nomor KK" value="{{ old('no_kk') }}" id="id_kk">
                                @error('no_kk')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- Nama Lengkap --}}
                            <div class="col-lg-8 col-md-7 col-12 mb-2">
                                <label class="form-label" for="namaLengkap">Nama Lengkap</label>
                                <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Nama Lengkap Tanpa Gelar" value="{{ old('nama') }}" id="nama">
                                @error('nama')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- kondisi penduduk --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="kondisi">Kondisi Penduduk</label>
                                <select class="form-select js-choice" id="kondisi" size="1" name="id_kondisi" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Kondisi...</option>
                                    @foreach ($kondisi as $kondisi)
                                        <option value="{{ $kondisi->id }}" {{ old('id_kondisi') == $kondisi->id ? 'selected' : '' }}>{{ $kondisi->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_kondisi')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Hubungan dalam keluarga --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="hubungan">Hubungan dalam Keluarga</label>
                                <select class="form-select js-choice" id="hubungan" size="1" name="id_hubungan" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih hubungan...</option>
                                    @foreach ($hubungan as $hubungan)
                                        <option value="{{ $hubungan->id }}" {{ old('id_hubungan') == $hubungan->id ? 'selected' : '' }}>{{ $hubungan->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_hubungan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Jenis Kelamin --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="jk">Jenis Kelamin</label>
                                <select class="form-select js-choice" id="jk" size="1" name="jenisKelamin" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Jenis Kelamin...</option>
                                    <option value="Laki-laki" {{ old('jenisKelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenisKelamin')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Status Penduduk --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="status">Status Penduduk</label>
                                <select class="form-select js-choice" id="status" size="1" name="statusPenduduk" data-options='{"removeItemButton":true,"placeholder":true, "shouldSort": false}'>
                                    <option value="">Pilih Status Penduduk...</option>
                                    <option value="Tetap" {{ old('statusPenduduk') == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                                    <option value="Tidak Tetap" {{ old('statusPenduduk') == 'Tidak Tetap' ? 'selected' : '' }}>Tidak Tetap</option>
                                </select>
                                <small class="text-danger">
                                    @error('statusPenduduk')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            {{-- Agama --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="agama">Agama</label>
                                <select class="form-select js-choice" id="agama" size="1" name="id_agama" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Agama...</option>
                                    @foreach ($agama as $agama)
                                        <option value="{{ $agama->id }}" {{ old('id_agama') == $agama->id ? 'selected' : '' }}>{{ $agama->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_agama')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Kewarganegaraan --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="status">Status Warga Negara</label>
                                <select class="form-select js-choice" id="status" size="1" name="kewarganegaraan" data-options='{"removeItemButton":true,"placeholder":true, "shouldSort": false}'>
                                    <option value="">Pilih Status Warga Negara...</option>
                                    <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                    <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                    <option value="DUA KEWARGANEGARAAN" {{ old('kewarganegaraan') == 'DUA KEWARGANEGARAAN' ? 'selected' : '' }}>DUA KEWARGANEGARAAN</option>
                                </select>
                                @error('kewarganegaraan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="col-12 bg-300 pt-2 mt-2 mb-2">
                                <h5 class="fw-semi-bold">Alamat :</h5>
                            </div>
                            {{-- Dusun --}}
                            <div class="col-lg-6 col-md-4 col-12 mb-2">
                                <label class="form-label" for="status">Dusun</label>
                                <select class="form-select js-choice" id="dusun" size="1" name="id_dusun" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Dusun...</option>
                                    @foreach ($data as $dusun)
                                        <option value="{{ $dusun['id'] }}">{{ $dusun['nama'] }}</option>
                                    @endforeach
                                </select>
                                @error('id_dusun')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- RW --}}
                            <div class="col-lg-3 col-md-4 col-12 mb-2">
                                <label class="form-label" for="status">RW</label>
                                <select class="form-select" id="rw" size="1" name="id_rw" disabled>
                                    <option value="">Pilih RW...</option>
                                    {{-- @foreach ($data as $dusun)
                                        <option value="{{ $dusun['id'] }}" {{ old('id_dusun') == $dusun['id'] ? 'selected' : '' }}>{{ $dusun['nama'] }}</option>
                                    @endforeach --}}
                                </select>
                                @error('id_rw')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- RT --}}
                            <div class="col-lg-3 col-md-4 col-12 mb-2">
                                <label class="form-label" for="status">RT</label>
                                <select class="form-select" id="rt" size="1" name="id_rt" disabled>
                                    <option value="">Pilih RT...</option>
                                    {{-- @foreach ($data as $dusun)
                                        <option value="{{ $dusun['id'] }}" {{ old('id_dusun') == $dusun['id'] ? 'selected' : '' }}>{{ $dusun['nama'] }}</option>
                                    @endforeach --}}
                                </select>
                                @error('id_rt')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Alamat Sebelumya --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="alamat_sebelumnya">Alamat Sebelumnya</label>
                                <input class="form-control  @error('alamat_sebelumnya') is-invalid @enderror" type="text" name="alamat_sebelumnya" placeholder="Alamat Sekarang" value="{{ old('alamat_sebelumnya') }}" id="alamat_sebelumnya">
                                @error('alamat_sebelumnya')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- alamat sekarang --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="alamat_sekarang">Alamat Sekarang</label>
                                <input class="form-control  @error('alamat_sekarang') is-invalid @enderror" type="text" name="alamat_sekarang" placeholder="Alamat Sekarang" value="{{ old('alamat_sekarang') }}" id="alamat_sekarang">
                                @error('alamat_sekarang')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- data kelahiran --}}
                            <div class="col-12 bg-300 pt-2 mt-2 mb-2">
                                <h5 class="fw-semi-bold">Data Kelahiran :</h5>
                            </div>
                            {{-- no akta lahir --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="no_akta_kelahiran">Nomor Akta Kelahiran</label>
                                <input class="form-control  @error('no_akta_kelahiran') is-invalid @enderror" type="text" name="no_akta_kelahiran" placeholder="Nomor akta kelahiran..." value="{{ old('no_akta_kelahiran') }}" id="no_akta_kelahiran">
                                @error('no_akta_kelahiran')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 mb-2">
                                <label class="form-label" for="tempatLahir">Tempat Lahir</label>
                                <input class="form-control  @error('tempatLahir') is-invalid @enderror" type="text" name="tempatLahir" placeholder="Tempat lahir" value="{{ old('tempatLahir') }}" id="tempatLahir">
                                @error('tempatLahir')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- tanggal lahir --}}
                            <div class="col-lg-3 col-md-6 col-12 mb-2">
                                <label class="form-label" for="tanggalLahir">Tanggal Lahir</label>

                                <input class="form-control datetimepicker @error('tanggalLahir') is-invalid @enderror" id="tanggalLahir" type="text" placeholder="Masukkan Tanggal Lahir" data-options='{"dateFormat": "d M Y","disableMobile":true,"allowInput":true, "maxDate": "today"}' name="tanggalLahir" value="{{ old('tanggalLahir') }}" />
                                @error('tanggalLahir')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- data kesehatan --}}
                            <div class="col-12 bg-300 pt-2 mt-2 mb-2">
                                <h5 class="fw-semi-bold">Data Kesehatan :</h5>
                            </div>
                            {{-- golongan darah --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="golongan_darah">Golongan Darah</label>
                                <select class="form-select js-choice" id="golongan_darah" size="1" name="id_golongan_darah" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Golongan Darah...</option>
                                    @foreach ($golongan_darah as $golongan_darah)
                                        <option value="{{ $golongan_darah->id }}" {{ old('id_golongan_darah') == $golongan_darah->id ? 'selected' : '' }}>{{ $golongan_darah->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_golongan_darah')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- cacat --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="kecacatan">Kecacatan</label>
                                <select class="form-select js-choice" id="kecacatan" size="1" name="id_cacat" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Kecacatan...</option>
                                    @foreach ($kecacatan as $kecacatan)
                                        <option value="{{ $kecacatan->id }}" {{ old('id_cacat') == $kecacatan->id ? 'selected' : '' }}>{{ $kecacatan->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_cacat')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Penyakit --}}
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="penyakit">Riwayat Penyakit</label>
                                <select class="form-select js-choice" id="penyakit" size="1" name="id_penyakit" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Riwayat Penyakit...</option>
                                    @foreach ($penyakit as $penyakit)
                                        <option value="{{ $penyakit->id }}" {{ old('id_penyakit') == $penyakit->id ? 'selected' : '' }}>{{ $penyakit->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_penyakit')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Status Perkawinan --}}
                            <div class="col-12 bg-300 pt-2 mt-2 mb-2">
                                <h5 class="fw-semi-bold">Status Perkawinan :</h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="status_kawin">Status Perkawinan</label>
                                <select class="form-select js-choice" id="status_kawin" size="1" name="id_status_kawin" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Status Kawin...</option>
                                    @foreach ($status_kawin as $status_kawin)
                                        <option value="{{ $status_kawin->id }}" {{ old('id_status_kawin') == $status_kawin->id ? 'selected' : '' }}>{{ $status_kawin->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_status_kawin')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="no_akta_perkawinan">Nomor Akta Perkawinan</label>
                                <input class="form-control  @error('no_akta_perkawinan') is-invalid @enderror" type="text" name="no_akta_perkawinan" placeholder="Nomor akta perkawinan..." value="{{ old('no_akta_perkawinan') }}" id="no_akta_perkawinan">
                                @error('no_akta_perkawinan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
                                <label class="form-label" for="no_akta_perceraian">Nomor Akta Perceraian</label>
                                <input class="form-control  @error('no_akta_perceraian') is-invalid @enderror" type="text" name="no_akta_perceraian" placeholder="Nomor akta perceraian..." value="{{ old('no_akta_perceraian') }}" id="no_akta_perceraian">
                                @error('no_akta_perceraian')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- pendidikan dan pekerjaan --}}
                            <div class="col-12 bg-300 pt-2 mt-2 mb-2">
                                <h5 class="fw-semi-bold">Pendidikan dan Pekerjaan :</h5>
                            </div>
                            {{-- pendidikan dalam kk --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="pendidikan_kk">Pendidikan dalam KK</label>
                                <select class="form-select js-choice" id="pendidikan_kk" size="1" name="id_pendidikan_kk" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Pendidikan dalam KK...</option>
                                    @foreach ($pendidikan_kk as $pendidikan_kk)
                                        <option value="{{ $pendidikan_kk->id }}" {{ old('id_pendidikan_kk') == $pendidikan_kk->id ? 'selected' : '' }}>{{ $pendidikan_kk->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_pendidikan_kk')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- pendidikan yang sedang ditempuh --}}
                            <div class="col-lg-6 col-md-6 col-12 mb-2">
                                <label class="form-label" for="sedang_pendidikan">Pendidikan Sedang Ditempuh</label>
                                <select class="form-select js-choice" id="sedang_pendidikan" size="1" name="id_sedang_pendidikan" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih pendidikan yang sedang ditempuh...</option>
                                    @foreach ($sedang_pendidikan as $sedang_pendidikan)
                                        <option value="{{ $sedang_pendidikan->id }}" {{ old('id_sedang_pendidikan') == $sedang_pendidikan->id ? 'selected' : '' }}>{{ $sedang_pendidikan->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_sedang_pendidikan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- pekerjaan --}}
                            <div class="col-12 mb-2">
                                <label class="form-label" for="pekerjaan">Pekerjaan</label>
                                <select class="form-select js-choice" id="pekerjaan" size="1" name="id_pekerjaan" data-options='{"removeItemButton":true,"placeholder":true,"shouldSort": false}'>
                                    <option value="">Pilih Pekerjaan...</option>
                                    @foreach ($pekerjaan as $pekerjaan)
                                        <option value="{{ $pekerjaan->id }}" {{ old('id_pekerjaan') == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->nama }}</option>
                                    @endforeach

                                </select>
                                @error('id_pekerjaan')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- Data Orang Tua --}}
                            <div class="col-12 bg-300 pt-2 mt-2 mb-2">
                                <h5 class="fw-semi-bold">Data Orang Tua :</h5>
                            </div>
                            {{-- NIK ayah --}}
                            <div class="col-lg-4 col-md-5 col-12 mb-2">
                                <label class="form-label" for="nik_ayah">NIK Ayah</label>
                                <input class="form-control  @error('nik_ayah') is-invalid @enderror" type="number" name="nik_ayah" placeholder="Masukkan NIK Ayah" value="{{ old('nik_ayah') }}" maxlength="16" id="nik_ayah">
                                @error('nik_ayah')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Nama Lengkap ibu --}}
                            <div class="col-lg-8 col-md-7 col-12 mb-2">
                                <label class="form-label" for="nama_ayah">Nama Ayah</label>
                                <input class="form-control  @error('nama_ayah') is-invalid @enderror" type="text" name="nama_ayah" placeholder="Nama Lengkap Ayah Tanpa Gelar" value="{{ old('nama_ayah') }}" id="nama_ayah">
                                @error('nama_ayah')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- nik ibu --}}
                            <div class="col-lg-4 col-md-5 col-12 mb-2">
                                <label class="form-label" for="nik_ibu">NIK Ibu</label>
                                <input class="form-control  @error('nik_ibu') is-invalid @enderror" type="number" name="nik_ibu" placeholder="Masukkan NIK Ibu" value="{{ old('nik_ibu') }}" maxlength="16" id="nik_ibu">
                                @error('nik_ibu')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- Nama Lengkap --}}
                            <div class="col-lg-8 col-md-7 col-12 mb-2">
                                <label class="form-label" for="nama_ibu">Nama Ibu</label>
                                <input class="form-control  @error('nama_ibu') is-invalid @enderror" type="text" name="nama_ibu" placeholder="Nama Lengkap Ibu Tanpa Gelar" value="{{ old('nama_ibu') }}" id="nama_ibu">
                                @error('nama_ibu')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>


                        </div>
                        <a href="{{ route('admin.kependudukan') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                        </a>
                        <button class="btn btn-primary me-2 mb-1" type="submit">
                            <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('css')
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

    <script>
        $(document).ready(function() {
            $('#file_input').change(function() {
                var file = $(this)[0].files[0];
                var reader = new FileReader();

                // Ketika file telah selesai di-load
                reader.onload = function(e) {
                    // Ubah href dari a tag dengan id preview_img
                    // Ubah src dari img tag yang menjadi child dari a tag tersebut
                    $('#preview_img').attr('src', e.target.result);

                }

                reader.readAsDataURL(file);
            });
            // Simpan elemen input pada variabel
            var $akta_perkawinan = $('#no_akta_perkawinan');
            var $akta_perceraian = $('#no_akta_perceraian');

            // Fungsi untuk menonaktifkan inputan akta perkawinan dan perceraian
            function disableInputan() {
                $akta_perkawinan.prop('disabled', true);
                $akta_perceraian.prop('disabled', true);
            }

            // Fungsi untuk mengaktifkan inputan akta perkawinan dan perceraian
            function enableInputan() {
                $akta_perkawinan.prop('disabled', false);
                $akta_perceraian.prop('disabled', false);
            }

            // Panggil fungsi disableInputan() saat halaman dimuat
            disableInputan();

            // Tambahkan event listener pada inputan status perkawinan
            $('#status_kawin').on('change', function() {
                var status_kawin = $(this).val();

                // Jika status kawin belum menikah
                if (status_kawin == 1) {
                    // Nonaktifkan inputan akta perkawinan dan perceraian
                    disableInputan();
                }
                // Jika status kawin sudah menikah atau cerai mati
                else if (status_kawin == 2 || status_kawin == 4) {
                    // Nonaktifkan inputan akta perkawinan
                    $akta_perkawinan.prop('disabled', false);
                    // Aktifkan inputan akta perceraian
                    $akta_perceraian.prop('disabled', true);
                }
                // Jika status kawin cerai hidup
                else if (status_kawin == 3) {
                    // Aktifkan inputan akta perkawinan dan perceraian
                    enableInputan();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // Simpan data yang sudah di-parse pada variabel js
            var data = {!! json_encode($data) !!};

            // Ketika pilihan dusun berubah, tampilkan opsi RW yang sesuai
            $('#dusun').on('change', function() {
                var dusunId = $(this).val();
                var dusun = data.find(function(dusun) {
                    return dusun.id == dusunId;
                });
                if (dusun) {
                    $('#rw').empty().prop('disabled', false);
                    console.log(dusun);
                    $('#rw').append($('<option>', {
                        value: '',
                        text: 'Pilih RW..'
                        
                    }));
                    dusun.rw.forEach(function(rw) {
                        $('#rw').append($('<option>', {
                            value: rw.id,
                            text: rw.nama
                        }));
                    });

                    // Nonaktifkan opsi RT
                } else {
                    $('#rw').empty().prop('disabled', true);
                }
                $('#rt').empty().prop('disabled', true);
                // Tampilkan opsi RW yang sesuai

            });

            // Ketika pilihan RW berubah, tampilkan opsi RT yang sesuai
            $('#rw').on('change', function() {
                var rwId = $(this).val();
                var rw = null;

                // Cari RW yang sesuai
                for (var i = 0; i < data.length; i++) {
                    var dusun = data[i];
                    rw = dusun.rw.find(function(rw) {
                        return rw.id == rwId;
                    });
                    if (rw) {
                        break;
                    }
                }

                // Tampilkan opsi RT yang sesuai
                $('#rt').empty().prop('disabled', false);
                $('#rt').append($('<option>', {
                    value: '',
                    text: 'Pilih RT...'
                }));
                rw.rt.forEach(function(rt) {
                    $('#rt').append($('<option>', {
                        value: rt.id,
                        text: rt.name
                    }));
                });
               
            });
        });
    </script>
@endpush
