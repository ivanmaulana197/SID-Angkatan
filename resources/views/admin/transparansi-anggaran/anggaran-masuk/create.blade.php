@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Anggaran Masuk</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.transparansi-anggaran') }}">Transparansi Anggaran</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Anggaran Masuk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Anggaran Masuk</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transparansi-anggaran.anggaran-masuk.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nama">Nama Anggaran</label>
                    <div class="col-sm-10">
                        <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Masukkan Nama Anggaran" value="{{ old('nama') }}" id="nama">
                        <small class="text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                    <div class="col-sm-10">
                        <input class="form-control datetimepicker @error('tanggal') is-invalid @enderror" id="tanggal" type="text" placeholder="Masukkan Tanggal" data-options='{"dateFormat": "d M Y","disableMobile":true,"allowInput":true, "maxDate": "today"}' name="tanggal" value="{{ old('tanggal') }}" />
                        @error('tanggal')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="total">Jumlah Anggaran</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" class="rupiah-input form-control" onkeyup="formatRupiah(this)" placeholder="Masukkan nominal rupiah" name="total" value="{{ old('total') }}">
                        </div>
                        @error('total')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="keterangan" cols="30" rows="3" placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>

                <a href="{{ route('admin.transparansi-anggaran') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                </a>
                <button class="btn btn-primary me-2 mb-1" type="submit">
                    <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
        function formatRupiah(input) {
            // Mengambil nilai input
            var value = input.value;

            // Menghapus semua karakter selain angka
            value = value.replace(/[^\d]/g, '');

            // Mengubah angka menjadi format rupiah menggunakan Numeral.js
            var formattedValue = numeral(value).format('0,0');

            // Menampilkan nilai yang telah diformat ke input
            input.value = formattedValue;
        }
    </script>
@endpush
