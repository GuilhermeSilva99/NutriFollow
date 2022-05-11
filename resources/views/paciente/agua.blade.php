<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pacientes</title>
    <style>
        .bd-example-row {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid;
        }

    </style>
</head>
@extends('home')

<x-guest-layout>

    <div class="row cards justify-content-center pt-4">
        <div class="col-6">
            <br><br><br><br><br>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Relatório de Dieta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/nutricionista/paciente/agua/{{ $id }}">Relatório de
                        Consumo de Água</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/nutricionista/paciente/sono/{{ $id }}">Relatório de
                        qualidade do Sono</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="/nutricionista/listar/pacientes">Listar Pascientes</a>
                </li> --}}
            </ul>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="container"></div>
                </div>
            </div>

        </div>
      
        
    </div>
    <a class="nav-link" href="/nutricionista/listar/pacientes">Listar Pascientes</a>
    <div>
        <form  method="get">
            @csrf
            <button type="button" class="btn btn-outline-dark">Dark</button>
            {{-- <button class="btn btn-outline-secondary" type="submit" id="button-dieta">Listar</button> --}}
        </form>
    </div>

    <div>
        <form class="form-inline" method="POST" action="{{ route('agua', $id) }}" style="justify-content: center; margin-top: 15px;">
            @csrf
            <div>Intervalo</div> 
            <div class="form-group" style="margin: 3px;">
                <input type="date" class="form-control" name="inicio" autocomplete="off"/>
            </div>
            <span> A </span>
            <div class="form-group" style="margin: 3px;">
                <input type="date" class="form-control" name="fim" autocomplete="off"/>
            </div>
            <button class="btn btn-success" type="submit">Filtrar</button>
        </form>
    </div>

    
</x-guest-layout>

</html>

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
            text: 'Relatório de Consumo de Água do Paciente'
        },
        // subtitle: {
        //     text: 'Quantidade e qualidade de sono do paciente no período'
        // },
        xAxis: {
            categories: <?= $dias ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Água (Listros)'
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
        series: [<?= $quantidade ?>]

    });
</script>
