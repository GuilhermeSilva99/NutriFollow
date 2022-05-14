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
                <br><h2>{{$paciente->user->nome}} - Relatórios</h2><br><br>
                <div class="mx-auto" style="width: 680px;">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                        <a class="nav-link active" href="/nutricionista/paciente/relatorio-dieta/{{$id}}">Relatório de Dieta</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/nutricionista/paciente/agua/{{$id}}">Relatório de Consumo de Água</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/nutricionista/paciente/sono/{{$id}}" >Relatório de qualidade do Sono</a>
                        </li>
                    </ul>
                </div>
    
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div id="container"></div>
                    </div>
                    <div class="col align-self-end " style="width: 150px;">
                        <a href="/nutricionista/listar/pacientes" class="btn btn-outline-secondary btn-sm">Listar Pascientes</a>
                    </div>
                    <br>
                </div>
                <form method="POST" action="{{ route('dieta.relatorio', $id) }}">
                    @csrf
                    <div class="container mt-5" style="max-width: 450px">
                        <div class="row form-group">       
                            <label class="col-sm-5 col-form-label">Início</label> 
                            <label class="col-sm-1 col-form-label">Fim</label>                        
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="date" class="input-sm form-control" name="inicio" autocomplete="off"/>
                                <input type="date" class="input-sm form-control" name="fim" autocomplete="off"/>
                                <button class="btn btn-success" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>

                
                <table class="table align-middle table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Calorias</th> 
                        <th scope="col">Visualizar</th>       
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($refeicoes as $data)
                            <tr scope="row">
                                <th scope="col">{{array_keys($refeicoes, $data)[0]}}</th>
                                <th>
                                @foreach ($data as $refeicao)                                  
                                        {{$refeicao->horario}}<br>
                                @endforeach
                                </th>
                                <th>
                                @foreach ($data as $refeicao)
                                    {{$refeicao->caloria}}<br> 
                                @endforeach
                                </th>
                                <th><button class="btn btn-sm btn-outline-info"  data-bs-toggle="modal" data-bs-target="#modal-dieta-{{$data[0]->data}}">Visualizar Detalhes</button></th>       
                            </tr>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modal-dieta-{{$data[0]->data}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel"><h4>Detalhes de refeições - {{$data[0]->dia_da_semana}} - {{$data[0]->data}}</h4></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($data as $refeicao)
                                                <br>
                                                <div class="col mx-auto text-center">
                                                    <img class="img-responsive" src="{{$refeicao->foto}} height="500" width="500"">
                                                </div>
                                                <p class="text-center">Refeição: {{$refeicao->nome_refeicao}}</p>
                                                <p>Horário: {{$refeicao->horario}}</p>
                                                <p>Calorias: {{$refeicao->caloria}}</p>
                                                <p>
                                                Descrição: {{$refeicao->descricao_refeicao}}
                                                </p>
                                            <br><hr><br>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-guest-layout>
    
</html>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('container', {

    title: {
        text: 'Calorias Consumidas no Periodo'
    },

    yAxis: {
        title: {
            text: 'Calorias por data'
        }
    },

    xAxis: {
    	categories: <?= $datas ?>,
        crosshair: true
    },

    series: [{
        name: 'Calorias',
        data: <?= $calorias ?>
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

    });
</script>