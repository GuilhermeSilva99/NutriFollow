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
    @section('content')
    <body class="antialiased">
        <br>
        <br>
        <br>
        <br>
        <div class="card-body">
            <div class="card-body">
            <h1>Lista de Refeições</h1>
            <ul>
                @foreach ($refeicoes as $refeicao)
                <div class = "bd-example bd-example-row">
                    <div class="container">
                        
                        <div class = "row" >
                            <div class = "col-2">                            
                                {{$refeicao->descricao_refeicao}}
                            </div>
                            <div class = "col-2">                            
                                {{$refeicao->caloria}}
                            </div>
                            <div class = "col-2">                            
                                {{$refeicao->horario}}
                            </div>
                            <div class = "col-2">                            
                               {{$refeicao->nome_refeicao}}
                            </div>
                            <form method="get" action="{{ route('refeicao.editarRefeicao', $refeicao->id) }}" >
                            @csrf
                                <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Editar</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </ul>
            
            <form method="GET" action="{{ route('refeicao.PrepDietaRef', $dieta_id) }}">
                @csrf

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <x-jet-button>
                            {{ __('Adiconar Refeição') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
            
        </div>
    </body>
    @endsection
</html>