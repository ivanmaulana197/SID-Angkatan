<div class="card text-white bg-success">
    <div class="card-text d-flex justify-content-center p-2 fs-2 fw-bolder" style="color:white">
        STATISTIK PENGUNJUNG
    </div>
</div>
<canvas class="max-w-100" id="pengunjung" width="1618" height="1000"></canvas>

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
