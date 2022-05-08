<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dietas</title>
        <style>
            .bd-example-row {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid;
            }
        </style>
    </head>
    @extends('home')
    @section('content')
    <body class="antialiased">
        <br><br>
        <h1>Dietas</h1>
        <ul>
            @foreach ($dietas as $dieta)
            <div class = "bd-example bd-example-row">
                <div class="container">
                    <div class = "row" >
                        <div class = "col-3">                            
                            {{$dieta->descricao}}
                        </div>
                        <div class = "col-3">                            
                            {{$dieta->data_inicio}}
                        </div>
                        <div class = "col-3">                            
                            {{$dieta->data_fim}}
                        </div>
                        <form action="{{ route('dieta.view-dieta',[$dieta->id]) }}" method="get">
                            @csrf
                            <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Detalhes</button>
                        </form>
                        
                    </div>
                    
                </div>
            </div>
            @endforeach
        </ul>
        <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/register-paciente'">Cadastar Novo</button>
        {{-- <button  onclick="document.location='/nutricionista/register-paciente'"> Cadastrar </button> --}}
    </body>
    @endsection
</html>