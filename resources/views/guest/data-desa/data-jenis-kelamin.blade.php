@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            @include('guest.home.components.data-statistik-penduduk')
            {{-- @include('guest.home.components.banner') --}}
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    DATA JENIS KELAMIN
                </h5>
            </div>

            <div class="card">
                <div class="card-body">

                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <div class="highcharts-description mt-2">
                            <div class="table-responsive scrollbar">
                                <table class="table table-bordered table-striped fs--1 mb-0">
                                    <thead class="bg-200 text-900">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jumlah Penduduk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jk as $key=>$data)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $data }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                        </div>
                    </figure>
                </div>
            </div>

        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection

@push('js')
    <script>
        var data = @php echo json_encode($jk); @endphp;
        var hasil = Object.entries(data).map(([key, value]) => [key, parseInt(value)])
        console.log(data);
        
        Highcharts.chart('container', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'DATA PENDUDUK BERDASARKAN JENIS KELAMIN'
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y'],
                data: hasil,
                showInLegend: true,
                name: 'jumlah penduduk'
            }]
        });
    </script>
@endpush
