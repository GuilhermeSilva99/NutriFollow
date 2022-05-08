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
            @foreach ($pacientes as $paciente)
            <div class = "bd-example bd-example-row">
                <div class="container">
                    <div class = "row" >
                        <div class = "col-2">                            
                            {{$paciente->user->nome}} {{$paciente->user->email}} {{$paciente->user->telefone_1}} {{$paciente->user->telefone_2}}
                        </div>
                        <div class = "col-1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/editar/paciente/{{$paciente->user->id}}'">Editar</button>
                        </div>
                        
                        <div class = "col-1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="document.location='/view/paciente/{{$paciente->user->id}}'">Visualiza</button>
                        </div>
                        
                        <div class = "col-1">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon3" onclick="document.location='/paciente/password/{{$paciente->user->id}}'">Reset Password</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </ul>
        <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/paciente/register-paciente'">Cadastar Novo</button>
        {{-- <button  onclick="document.location='/paciente/register-paciente'"> Cadastrar </button> --}}
    </body>
    @endsection
</html>