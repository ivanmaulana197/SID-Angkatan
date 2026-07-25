@extends('layouts.main')

@section('content')
    @include('admin.dashboard.components.header')


    <div class="row mb-3">
        <div class="col ">
            <div class="card">
                <div class="card-text d-flex justify-content-center p-2 fs-2 fw-bolder" >
                    STATISTIK PENGUNJUNG
                </div>
                <div class="card-body">
                    <canvas class="max-w-100" id="pengunjung" width="1618" height="500"></canvas>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 mb-3">
            @include('admin.dashboard.components.data-agama')
        </div>
        <div class="col-sm-6 mb-3">
            @include('admin.dashboard.components.data-pekerjaan')
        </div>
        <div class="col-sm-6 mb-3">
            @include('admin.dashboard.components.data-pendidikan')
        </div>
        <div class="col-sm-6 mb-3">
            @include('admin.dashboard.components.data-umur')
        </div>
       
    </div>
@endsection
@push('js')
<script>
    const line = document.getElementById('pengunjung');
    var pengunjung = @php echo json_encode($myData['pengunjung']); @endphp;
    var totalSeluruhPengunjung = @php echo json_encode($myData['pengunjung-semua']); @endphp;
    // let hasil = data.map(item => [item]);
    

    const lineChart = new Chart(line, {
        type: 'line',
        data: {
            labels: pengunjung['label-tanggal'],
            datasets: [{
                label: "Jumlah Pengunjung",
                data: pengunjung['jumlah-pengunjung'],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',

                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Total Pengunjung: '+(totalSeluruhPengunjung)
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endpush