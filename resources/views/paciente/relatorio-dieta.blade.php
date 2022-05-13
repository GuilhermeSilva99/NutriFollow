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
                <br><br><br>
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
                        <tr scope="row">
                            <th scope="col">01/05/2022</th>
                            <th>06:00 <br>
                                09:00 <br>
                                12:00 <br>
                                15:00 <br>
                                18:00 <br>
                                21:00
                            </th>
                            <th>520 <br>
                                300 <br>
                                800 <br>
                                500 <br>
                                600 <br>
                                279
                            </th> 
                            <th><button class="btn btn-sm btn-outline-info"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Visualizar Detalhes</button></th>       
                          </tr>
                          <tr scope="row">
                            <th scope="col">02/05/2022</th>
                            <th>06:00 <br>
                                09:00 <br>
                                12:00 <br>
                                15:00 <br>
                                18:00 <br>
                                21:00
                            </th>
                            <th>520 <br>
                                300 <br>
                                800 <br>
                                500 <br>
                                600 <br>
                                279
                            </th> 
                            <th><button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Visualizar Detalhes</button></th>       
                          </tr>
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><h4>Detalhes de refeições - 01/05/2022</h4></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <br>
                                <div class="col mx-auto text-center">
                                    <img class="img-responsive" src="/images/logo.png" height="500" width="500">
                                </div>
                                <p class="text-center">Café da manhã</p>
                                <p>Calorias: 600</p>
                                <p>
                                Observasões: Mussum Ipsum, cacilds vidis litro abertis. Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis.Mauris nec dolor in eros commodo tempor. Aenean aliquam molestie leo, vitae iaculis nisl.Em pé sem cair, deitado sem dormir, sentado sem cochilar e fazendo pose.Paisis, filhis, espiritis santis.
                                </p>
                                <br><hr><br>

                                <div class="col mx-auto text-center">
                                    <img class="img-responsive" src="/images/logo.png" height="500" width="500">
                                </div>
                                <p class="text-center">Lanche da manhã</p>
                                <p>Calorias: 300</p>
                                <p>
                                Observasões: Mé faiz elementum girarzis, nisi eros vermeio.Quem manda na minha terra sou euzis!Detraxit consequat et quo num tendi nada.Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis.
                                </p>
                                <br><hr><br>


                                <div class="col mx-auto text-center">
                                    <img class="img-responsive" src="/images/logo.png" height="500" width="500">
                                </div>
                                <p class="text-center">Almoço</p>
                                <p>Calorias: 600</p>
                                <p>
                                Observasões: Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum.Casamentiss faiz malandris se pirulitá.Quem num gosta di mim que vai caçá sua turmis!Si u mundo tá muito paradis? Toma um mé que o mundo vai girarzis!
                                </p>
                                <br><hr><br>

                                <div class="col mx-auto text-center">
                                    <img class="img-responsive" src="/images/logo.png" height="500" width="500">
                                </div>
                                <p class="text-center">Lanche da tarde</p>
                                <p>Calorias: 500</p>
                                <p>
                                Observasões: Admodum accumsan disputationi eu sit. Vide electram sadipscing et per.Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.Detraxit consequat et quo num tendi nada.Mé faiz elementum girarzis, nisi eros vermeio.
                                </p>
                                <br><hr><br>

                                <div class="col mx-auto text-center">
                                    <img class="img-responsive" src="/images/logo.png" height="500" width="500">
                                </div>
                                <p class="text-center">Jantar</p>
                                <p>Calorias: 600</p>
                                <p>
                                Observasões: Pra lá , depois divoltis porris, paradis.Admodum accumsan disputationi eu sit. Vide electram sadipscing et per.Suco de cevadiss deixa as pessoas mais interessantis.Leite de capivaris, leite de mula manquis sem cabeça.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
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
        chart: {
            type: 'column'
        },
        title: {
            text: 'Relatório de Calorias Consumidas Pelo Paciente'
        },
        xAxis: {
            categories: [1],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Calorias'
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
        series: [[1, 2, 3, 4]]
    
    });
</script>