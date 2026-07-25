<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data Agama
        </div>
    </div>
    <div class="card-body">
        <div id="agama"></div>
    </div>
</div>

@push('js')
    <script>
        var agama = @php echo json_encode($data['agama']); @endphp;
        agama = agama.map((item) => [item.nama, parseInt(item.jumlah)]);
        
        // $coba = $data.map
        Highcharts.chart('agama', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'DATA PENDUDUK BERDASARKAN AGAMA'
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y'],
                data: agama,
                showInLegend: true,
                name: 'jumlah penduduk'
            }]
        });
    </script>
@endpush
