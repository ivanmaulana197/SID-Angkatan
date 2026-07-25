<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data Pendidikan
        </div>
    </div>
    <div class="card-body">
        <div id="pendidikan"></div>
    </div>
</div>

@push('js')
    <script>
        var pendidikan = @php echo json_encode($data['pendidikan']); @endphp;
        pendidikan = pendidikan.map((item) => [item.nama, parseInt(item.jumlah)]);
        
        // $coba = $data.map
        Highcharts.chart('pendidikan', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'DATA PENDUDUK BERDASARKAN PENDIDIKAN'
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y'],
                data: pendidikan,
                showInLegend: true,
                name: 'jumlah penduduk'
            }]
        });
    </script>
@endpush
