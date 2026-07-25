<div class="card text-white bg-success">
    <div class="card-text d-flex justify-content-center p-2 fs-2 fw-bolder" style="color:white">
        STATISTIK DESA
    </div>
</div>

<canvas class="max-w-100 mb-2" id="bar" height="300px"></canvas>


@push('js')
    
    <script>
        const ctx = document.getElementById('bar');
        var statistik = @php echo json_encode($myData['statistik']); @endphp;
        // let hasil = data.map(item => [item]);
        
        const stackedBar = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jumlah Penduduk', 'Laki-laki', 'Perempuan'],
                datasets: [{
                    label: '# of Votes',
                    data: [statistik['jumlah_penduduk'],statistik['jumlahLakiLaki'],statistik['jumlahPerempuan']],
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
    </script>
@endpush
