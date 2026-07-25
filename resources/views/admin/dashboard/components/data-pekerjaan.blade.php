<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data Pekerjaan
        </div>
    </div>
    <div class="card-body">
        <div id="pekerjaan"></div>
    </div>
</div>

@push('js')
    <script>
        var pekerjaan = @php echo json_encode($data['pekerjaan']); @endphp;
        pekerjaan = pekerjaan.map((item) => [item.nama, parseInt(item.jumlah)]);
        
        // $coba = $data.map
        Highcharts.chart('pekerjaan', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'DATA PENDUDUK BERDASARKAN PEKERJAAN'
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y'],
                data: pekerjaan,
                showInLegend: true,
                name: 'jumlah penduduk'
            }]
        });
    </script>
@endpush
