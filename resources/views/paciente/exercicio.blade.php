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
                        <a class="nav-link" href="/nutricionista/paciente/relatorio-dieta/{{$id}}">Relatório de Dieta</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/nutricionista/paciente/agua/{{$id}}">Relatório de Consumo de Água</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/nutricionista/paciente/sono/{{$id}}" >Relatório de qualidade do Sono</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/nutricionista/paciente/exercicio/{{$id}}" >Relatório de Exercício</a>
                        </li>
                    </ul>
                </div>
    
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-3">Data</th>
                                    <th scope="col-3">Exercício</th>
                                    <th scope="col-3">Duração</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach($exercicios as $exercicio)
                                <tr scope="row">
                                    <td>
                                        {{ date('d-m-y', strtotime($exercicio->data)) }}
                                    </td>
                                    <td>
                                        {{$exercicio->tipoExercicio->nome}}
                                    </td>
                                    <td>
                                        {{$exercicio->duracao}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col align-self-end " style="width: 150px;">
                        <a href="/nutricionista/listar/pacientes" class="btn btn-outline-secondary btn-sm">Listar Pascientes</a>
                    </div>
                    <br>
                </div>
                <form method="POST" action="{{ route('exercicio', $id) }}">
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
            </div>
        </div>
    </x-guest-layout>
    
</html>