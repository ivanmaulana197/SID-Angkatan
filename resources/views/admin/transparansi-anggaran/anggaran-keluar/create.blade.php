@extends('layouts.main')

@section('content')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Tambah Anggaran Keluar</h3>
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashobard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.transparansi-anggaran') }}">Transparansi Anggaran</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Anggaran Keluar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Tambah Anggaran Keluar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transparansi-anggaran.anggaran-keluar.store') }}" method="post">

                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nama">Nama Anggaran Keluar</label>
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
                    <label class="form-label" for="exampleFormControlInput1">Sumber Dana</label>
                    <div class="row">
                        <table class="table table-bordered">
                            <tbody id="table">
                                <tr>
                                    <th>Sumber Dana</th>
                                    <th>Jumlah Dikeluarkan</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr data-index="0">
                                    <th>
                                        <select class="form-select js-choice" id="inputs[0][dana]" size="1" name="inputs[0][dana]" data-options='{"placeholder":true,"shouldSort": false}'>
                                            <option value="">Pilih sumber dana...</option>
                                            @foreach ($anggaranMasuk as $data)
                                                <option value="{{ $data->id }}" {{ old('inputs.0.dana') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('inputs.0.dana')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </th>
                                    <th>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            <input type="text" class="rupiah-input form-control" onkeyup="formatRupiah(this)" placeholder="Masukkan nominal rupiah" name="inputs[0][total]" value="{{ old('inputs.0.total') }}" id="inputs_0_total">
                                        </div>
                                        @error('inputs.0.total')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-sm btn-success" id="add">add</button>
                                    </th>
                                </tr>
                                @if (old('inputs'))
                                    @foreach (old('inputs') as $key => $input)
                                        @if ($key == 0)
                                            @continue
                                        @endif
                                        <tr>
                                            <th>
                                                <select class="form-select js-choice" id="inputs_{{ $key }}_dana" size="1" name="inputs[{{ $key }}][dana]" data-options='{"placeholder":true,"shouldSort": false}'>
                                                    <option value="">Pilih sumber dana...</option>
                                                    @foreach ($anggaranMasuk as $data)
                                                        <option value="{{ $data->id }}" {{ $input['dana'] == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error("inputs.{$key}.dana")
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </th>
                                            <th>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                    <input type="text" class="rupiah-input form-control" onkeyup="formatRupiah(this)" placeholder="Masukkan nominal rupiah" name="inputs[{{ $key }}][total]" id="inputs_{{ $key }}_total" value="{{ $input['total'] }}">
                                                </div>
                                                @error("inputs.{$key}.total")
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror

                                            </th>
                                            <th>
                                                <button type="button" class="btn btn-sm btn-danger remove-table">remove</button>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

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
                            <input type="text" class="rupiah-input form-control" onkeyup="formatRupiah(this)" placeholder="Masukkan nominal rupiah" name="jumlah" id="jumlah" readonly>
                        </div>
                        @error('jumlah')
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
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
        var jml = [];

        function addRow(index, danaValue = '', totalValue = '') {
            var newRow = `
            <tr data-index=${index}>
                <th>
                    <select class="form-select js-choice" id="inputs_${index}_dana" size="1" name="inputs[${index}][dana]" data-options='{"placeholder":true,"shouldSort": false}'>
                        <option value="">Pilih sumber dana...</option>
                        @foreach ($anggaranMasuk as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    
                </th>
                <th>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" class="rupiah-input form-control" onkeyup="formatRupiah(this)" placeholder="Masukkan nominal rupiah" id="inputs_${index}_total" name="inputs[${index}][total]" value="">
                        
                    </div>
                </th>
                <th>
                    <button type="button" class="btn btn-sm btn-danger remove-table">remove</button>
                </th>
            </tr>
            `;

            $('#table').append(newRow);
            var select = $(`#inputs_${index}_dana`);
            select.find('option').each(function() {
                if ($(this).val() === danaValue) {
                    $(this).prop('selected', true);
                    return false; // Keluar dari loop setelah menemukan nilai yang cocok
                }
            });
            // Inisialisasi Choices pada elemen select yang baru ditambahkan
            var selectElement = $(`#inputs_${index}_dana`)[0];
            var choices = new Choices(selectElement);

            // Set nilai pada elemen select dan input jika tersedia

            if (totalValue) {
                $(`#inputs_${index}_total`).val(totalValue);
            }
            var scriptCode = `
                jml[${index}]= 0;
                $('#inputs_${index}_total').keyup(function() {
                jml[${index}] = rpToInt($(this).val());
                var total = jml.reduce(function(acc, currentValue) {
                return acc + currentValue;
                }, 0);
                $('#jumlah').val(intToRp(total.toString()));

                });
            `;

            $('<script >').text(scriptCode).appendTo('#table ');
        }

        $(`#inputs_0_total`).keyup(function() {
            jml[0] = rpToInt($(this).val());
            var total = jml.reduce(function(acc, currentValue) {
                return acc + currentValue;
            }, 0);
            $('#jumlah').val(intToRp(total.toString()));

        });

        var i = 0;
        var listAnggaran = @php echo json_encode($anggaranMasuk); @endphp;

        if (i == listAnggaran.length - 1) {
            $('#add').prop("disabled", true);
        }

        $('#add').click(function() {
            ++i;
            if (i == listAnggaran.length - 1) {
                $('#add').prop("disabled", true);
            }
            addRow(i);
        });


        $(document).on('click', '.remove-table', function() {
            var rowIndex = parseInt($(this).closest('tr').attr('data-index'));
            jml[rowIndex] = 0;
            var total = jml.reduce(function(acc, currentValue) {
                return acc + currentValue;
            }, 0);
            $('#jumlah').val(intToRp(total.toString()));
            --i;

            if (i == listAnggaran.length - 1) {
                $('#add').prop("disabled", true);
            } else {
                $('#add').prop("disabled", false);
            }
            $(this).parents('tr').remove();
        });

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

        function intToRp(input) {
            value = input.replace(/[^\d]/g, '');
            // Mengubah angka menjadi format rupiah menggunakan Numeral.js
            var formattedValue = numeral(value).format('0,0');
            return formattedValue;
        }

        function rpToInt(input) {
            value = input.replace(/[^\d]/g, '');
            var numericValue = parseInt(value);
            return numericValue;
        }

        total1 = "{{ old('inputs.0.total') }}";
        if (total1) {
            jml[0] = rpToInt(total1);
            var total = jml.reduce(function(acc, currentValue) {
                return acc + currentValue;
            }, 0);
            $('#jumlah').val(intToRp(total.toString()));
        }

        var oldValues = @json(old('inputs', []));

        console.log(oldValues);
        oldValues.forEach(function(value, index) {
            if (index === 0) {
                return;
            }
            ++i;
            if (i == listAnggaran.length - 1) {
                $('#add').prop("disabled", true);
            }
            var danaOld = value.dana ? value.dana : '';
            var totalOld = value.total ? value.total : '';
            ada(index);
            jml[i] = rpToInt(totalOld);
            console.log(jml);
            var total = jml.reduce(function(acc, currentValue) {
                return acc + currentValue;
            }, i);
            $('#jumlah').val(intToRp(total.toString()));
        });

        function ada(index) {
            var scriptCode = `
                jml[${index}]= 0;
                $('#inputs_${index}_total').keyup(function() {
                    jml[${index}] = rpToInt($(this).val());
                    var total = jml.reduce(function(acc, currentValue) {
                    return acc + currentValue;
                    }, 0);
                    $('#jumlah').val(intToRp(total.toString()));

                });
            `;

            $('<script >').text(scriptCode).appendTo('#table');
        }
    </script>
@endpush
