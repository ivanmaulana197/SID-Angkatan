<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data usia
        </div>
    </div>
    <div class="card-body">
        <div id="usia"></div>
    </div>
</div>

@push('js')
    <script>
        var usia = @php echo json_encode($data['usia']); @endphp;
        usia = usia.map((item) => [item.nama, parseInt(item.jumlah)]);
        
        // $coba = $data.map
        Highcharts.chart('usia', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'DATA PENDUDUK BERDASARKAN USIA'
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y'],
                data: usia,
                showInLegend: true,
                name: 'jumlah penduduk'
            }]
        });
    </script>
@endpush
