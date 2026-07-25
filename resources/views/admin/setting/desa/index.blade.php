@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Pengaturan Desa</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Pengaturan Desa</li>
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
    <div class="card">
        <div class="card-header">
            <h5>
                Edit Profile Desa
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.desa.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2" for="nama">Nama Desa</label>
                    <div class="col-md-10">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama Desa" value="{{ old('nama', $desa->nama) }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="kode">Kode Desa</label>
                    <div class="col-md-10">
                        <input class="form-control  @error('kode') is-invalid @enderror" type="text" name="kode" placeholder="Masukkan Kode Desa" value="{{ old('kode', $desa->kode) }}" id="kode">
                        <small class="text-danger">
                            @error('kode')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="kecamatan">Nama Kecamatan</label>
                    <div class="col-md-10">
                        <input class="form-control  @error('kecamatan') is-invalid @enderror" type="text" name="kecamatan" placeholder="Masukkan Nama Kecamatan" value="{{ old('kecamatan', $desa->kecamatan) }}" id="kecamatan">
                        <small class="text-danger">
                            @error('kecamatan')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="kabupaten">Nama kabupaten</label>
                    <div class="col-md-10">
                        <input class="form-control  @error('kabupaten') is-invalid @enderror" type="text" name="kabupaten" placeholder="Masukkan Nama kabupaten" value="{{ old('kabupaten', $desa->kabupaten) }}" id="kabupaten">
                        <small class="text-danger">
                            @error('kabupaten')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="provinsi">Nama Provinsi</label>
                    <div class="col-md-10">
                        <input class="form-control  @error('provinsi') is-invalid @enderror" type="text" name="provinsi" placeholder="Masukkan Nama provinsi" value="{{ old('provinsi', $desa->provinsi) }}" id="provinsi">
                        <small class="text-danger">
                            @error('provinsi')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="alamat">Alamat</label>
                    <div class="col-md-10">
                        <textarea class="form-control  @error('alamat') is-invalid @enderror" type="text" name="alamat" placeholder="Masukkan alamat" id="alamat">{{ old('alamat', $desa->alamat) }}</textarea>
                        <small class="text-danger">
                            @error('alamat')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="telp">Telp</label>
                    <div class="col-md-10">
                        <textarea class="form-control  @error('telp') is-invalid @enderror" type="text" name="telp" placeholder="Masukkan Nomor Telp">{{ old('telp', $desa->telp) }}</textarea>
                        <small class="text-danger">
                            @error('telp')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2" for="sejarah_desa">Logo</label>
                    <div class="col-md-10">
                        <div class="col-lg-3 col-12 mb-3">
                            <div class="card align-items-center">
                                <div class="card-body bg-light">
                                    <div class="mb-3">
                                        <img id="preview_img" class="img-fluid rounded" src="{{ $desa->logo }}" alt="" />
                                    </div>
                                    @error('logo')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                    <div class="mb-3" style="display:none">
                                        <label for="file_input" class="form-label">Pilih File</label>
                                        <input id="file_input" type="file" class="form-control" name="logo">
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-sm btn-primary d-block mx-auto" onclick="document.getElementById('file_input').click();">Unggah</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_kepala_desa">Kepala Desa</label>
                    <div class="col-md-10">
                        <select class="form-select js-choice form-control @error('id_kepala_desa') is-invalid @enderror" id="id_kepala_desa" size="1" name="id_kepala_desa" data-options='{"placeholder":false}' aria-placeholder="Pilih kategori...">
                            @foreach ($penduduk as $data)
                                <option value={{ $data->id }} {{ old('id_kepala_desa', $desa->kepala->id) == $data->id ? 'selected' : '' }}>{{ $data->NIK }} -- {{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">
                            @error('id_kepala_desa')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="lokasi_desa">Link Embed Lokasi Desa</label>
                    <div class="col-md-10 mb-3">
                        <textarea class="form-control  @error('lokasi_desa') is-invalid @enderror" type="text" name="lokasi_desa" placeholder="Masukkan Link Lokasi Desa">{{ old('lokasi_desa', $desa->lokasi_desa) }}</textarea>
                        @error('lokasi_desa')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-12">
                        <!-- Button untuk membuka modal -->
                        <button type="button" class="badge badge-subtle-primary btn-primary" data-bs-toggle="modal" style="border: none;" data-bs-target="#previewLokasiDesa">
                            Preview Lokasi Desa
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="previewLokasiDesa" tabindex="-1" role="dialog" aria-labelledby="previewLokasiDesaLabel">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="previewLokasiDesaLabel">Preview Lokasi Desa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center pt-1">
                                                {!! old('lokasi_desa', $desa->lokasi_desa) ?? 'Gagal Memuat' !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="badge badge-subtle-info" style="border: none;" data-bs-toggle="modal" data-bs-target="#caraLinkEmbed">Cara Memasukkan Link Embed</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2" for="lokasi_kantor_desa">Link Embed Lokasi Kantor Desa</label>
                    <div class="col-md-10 mb-3">
                        <textarea class="form-control  @error('lokasi_kantor_desa') is-invalid @enderror" type="text" name="lokasi_kantor_desa" placeholder="Masukkan Link Lokasi Kantor Desa">{{ old('lokasi_kantor_desa', $desa->lokasi_kantor_desa) }}</textarea>
                        @error('lokasi_kantor_desa')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-12">
                        <!-- Button untuk membuka modal -->
                        <button type="button" class="badge badge-subtle-primary btn-primary" data-bs-toggle="modal" style="border: none;" data-bs-target="#previewLokasiKantorDesa">
                            Preview Lokasi Kantor Desa
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="previewLokasiKantorDesa" tabindex="-1" role="dialog" aria-labelledby="previewLokasiKantorDesaLabel">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="previewLokasiKantorDesaLabel">Preview Lokasi Kantor Desa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-center pt-1">
                                                {!! old('lokasi_kantor_desa', $desa->lokasi_kantor_desa) ?? 'Gagal Memuat' !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="badge badge-subtle-info" style="border: none;" data-bs-toggle="modal" data-bs-target="#caraLinkEmbed">Cara Memasukkan Link Embed</button>
                    </div>
                </div>

                <!-- Button trigger modal -->
                

                <!-- Modal -->
                <div class="modal fade" id="caraLinkEmbed" tabindex="-1" aria-labelledby="caraLinkEmbedLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="caraLinkEmbedLabel">Cara Memasukkan Link Embed Peta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>1. Buka <a href="https://maps.google.com/" target="_blank" rel="noopener noreferrer">google.maps</a></p>
                                
                                <p>2. Masukkan lokasi desa yang akan diembed lokasinya</p>
                                
                                <img src="{{ asset('img/petunjuk-embed/1.png') }}" width="500" alt="gambar1">
                                <br>
                                <p>3. Setelah itu klik tombol share</p>
                                <img src="{{ asset('img/petunjuk-embed/2.png') }}" width="500" alt="gambar1">
                                <br>
                                <p>4. setelah itu masuk ke Embed a Map</p>
                                
                                <img src="{{ asset('img/petunjuk-embed/3.png') }}" width="500" alt="gambar1">
                                <br>
                                <p>5. copy link tersebut dan letakkan di inputan embed sesuai dengan inputannya.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success me-2 mb-1" type="submit">
                    <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                </button>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
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
        });
    </script>
@endpush
