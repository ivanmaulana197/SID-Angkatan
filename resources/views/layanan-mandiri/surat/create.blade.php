@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Buat Permohonan Surat</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('layanan-mandiri') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Buat Permohonan Surat</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    @error('dokumen.*')
        <div class="alert alert-warning">
            <small class="text-danger">{{ $message }}</small>
        </div>
    @enderror

    <div class="card">
        <div class="card-header">
            <h5>Buat Permohonan Surat</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('layanan-mandiri.surat.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_jenis_dokumen">Jenis Dokumen</label>
                    <div class="col-sm-10">
                        <select class="form-select js-choice @if ($errors->has('id_jenis_surat')) is-invalid @endif" id="id_jenis_surat" size="1" name="id_jenis_surat" data-options='{"removeItemButton":true,"placeholder":true, }'>
                            <option value="">Pilih jenis surat...</option>
                            @foreach ($jenisSurat as $data)
                                <option value="{{ $data->id }}" {{ old('id_jenis_surat') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_jenis_surat')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_jenis_dokumen">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="keterangan" rows="3" placeholder="Keterangan tambahan" name="keterangan">{{ old('keterangan') }}</textarea>
                    </div>
                    @error('keterangan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="syarat-surat row mb-3 d-none">
                    <div class="col-md-12">
                        <h5>Syarat Surat</h5>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SYARAT</th>
                                    <th>Pilih Dokumen</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-syarat">

                            </tbody>
                        </table>
                    </div>
                </div>



                <a href="{{ route('layanan-mandiri') }}" class="btn btn-falcon-default me-2 mb-1" type="button">Kembali
                </a>
                <button class="btn btn-primary me-2 mb-1" type="submit">
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
            var syarat = [];
            var jenisSuratOld = "{{ old('id_jenis_surat') }}";

            if (jenisSuratOld) {
                syaratDokumen(jenisSuratOld);
            } else {
                console.log('tidak ada');
            }
            // Event saat jenis dokumen dipilih
            $('#id_jenis_surat').change(function() {
                // Ambil nilai ID jenis dokumen yang dipilih
                var jenisSuratId = $(this).val();
                if (jenisSuratId) {
                    syaratDokumen(jenisSuratId);
                }
                // Lakukan AJAX request menggunakan metode GET
                // Validasi saat tombol submit ditekan
            });

            function syaratDokumen(jenisSuratId) {
                $.ajax({
                    url: '/layanan-mandiri/get-syarat', // Ganti dengan URL rute di Laravel yang akan mengambil data syarat
                    method: 'GET',
                    data: {
                        id_jenis_surat: jenisSuratId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Tangkap data syarat yang diterima
                        syarat = response.syarat;
                        if (syarat.length > 0) {
                            var tbody = $('#tabel-syarat');
                            tbody.empty(); // Mengosongkan tbody sebelum mengisi dengan data baru
                            // Loop melalui data syarat dan tambahkan ke tbody
                            $.each(syarat, function(index, syarat) {
                                var row = $('<tr></tr>');
                                var nama = $('<td></td>').text(syarat['nama']);
                                var aksi = `
                                    <td>
                                        <select class="form-select js-choice @if ($errors->has('dokumen[]')) is-invalid @endif" id="id_dokumen_${syarat['id']}" size="1" name="dokumen[]" data-options='{"removeItemButton":true,"placeholder":true}'>
                                        <option value="">Pilih jenis surat...</option>
                                    
                                    </select>
                                    </td>`;

                                row.append([nama, aksi]);
                                tbody.append(row);
                                $.ajax({
                                    url: '/layanan-mandiri/dokumen-penduduk', // Ganti dengan URL endpoint Anda
                                    type: 'GET',
                                    data: {
                                        id_jenis_dokumen: syarat['id']
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        var dokumen = response.dokumen; // Mendapatkan data jenis surat

                                        var select = $(`#id_dokumen_${syarat['id']}`);
                                        select.empty(); // Mengosongkan opsi sebelum menambahkan opsi baru
                                        select.append('<option value="">Pilih jenis surat...</option>'); // Menambahkan opsi default
                                        $.each(dokumen, function(index, dokumen) {
                                            select.append('<option value="' + dokumen.id + '">' + dokumen.nama + '</option>'); // Menambahkan opsi baru
                                        });
                                        var selectElement = $(`#id_dokumen_${syarat['id']}`)[0];
                                        var choices = new Choices(selectElement);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText); // Menampilkan pesan error jika terjadi kesalahan
                                    }
                                });

                            });
                            $('.syarat-surat').removeClass('d-none');
                        } else {
                            $('.syarat-surat').addClass('d-none');
                        }

                        // Lakukan sesuatu dengan data syarat, misalnya menampilkan di console
                        console.log(syarat);
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika terjadi
                        console.error(xhr.responseText);
                    }
                });
            }

        });
    </script>
@endpush
