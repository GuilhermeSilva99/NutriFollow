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
        <br><br>
        <h1>Pacientes</h1>
        <ul>
            @foreach ($list_user as $user)
            {{-- {{dd($user->nome)}} --}}
            <div class = "bd-example bd-example-row">
                <div class="container">
                    <div class = "row">
                        <div class = "col-6">
                            
                            {{$user->nome}}  {{$user->email}} {{$user->telefone_1}} {{$user->telefone_2}}
                        </div>
                        <div class = "col-2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="document.location='/editar/paciente/{{$user->id}}'">Editar</button>
                        </div>
                        <div class = "col-2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="document.location='/remover/paciente/{{$user->id}}'">Excluir</button>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            @endforeach
        </ul>
        
        <button  onclick="document.location='/pasciente/create'"> Cadastrar </button>
    </body>
    @endsection
</html>