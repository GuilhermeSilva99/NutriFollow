<x-guest-layout>
    <div class="row cards justify-content-center pt-4">
        <div class="col-6">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Sono do Paciente'
        },
        subtitle: {
            text: 'Quantidade e qualidade dos últimos dias'
        },
        xAxis: {
            categories: <?= $dias ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sono'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [<?= $duracao ?>, <?= $qualidade ?>]
    
    });
</script>















{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <div class="card">
        <div class="card-header">{{ __('Registros de Sono') }}</div>
        <div class="card-body">
            <div id="container"></div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div id="container"></div>
            </div>
        </div>
    </div> --}}

    
   
</body>
</html> --}}