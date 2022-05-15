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
        <div class="row card justify-content-center pt-4">
            <div class="col">
                <div class="card-header"><h1>Lista de Pacientes</h1></div>
                <div class="card-body">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/register-paciente'">Cadastar Paciente</button>
                    <table class="table align-middle table-sm">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                            <tr>
                                <th scope="row">{{$paciente->user->nome}}</th>
                                <td>
                                    <form action="{{ route('nutricionista.listar.comorbidade.paciente', $paciente->id) }}" method="get">
                                        @csrf
                                        <button class="btn btn-outline-secondary" type="submit" id="button-dieta">Comorbidade</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('dieta.dietas',[$paciente->id]) }}" method="get">
                                        @csrf
                                        <button class="btn btn-outline-secondary" type="submit" id="button-dieta">Dieta</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('agua',[$paciente->user->id]) }}" method="get">
                                        @csrf
                                        <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Relátorios</button>
                                    </form>
                                </td>
                                <td><button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="document.location='/nutricionista/exibir/paciente/{{$paciente->user->id}}'">Visualiza</button></td>
                                <td><button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/editar/paciente/{{$paciente->user->id}}'">Editar</button></td>
                                <td><button class="btn btn-outline-secondary" type="button" id="button-addon3" onclick="document.location='/nutricionista/paciente/senha/{{$paciente->user->id}}'">Alterar Senha</button></td>
                                <td>
                                    <form action="{{ route('nutricionista.paciente.inativar', $paciente->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-secondary" type="submit"  dusk="desativar-button-{{$paciente->id}}">Desativar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $pacientes->links() !!}
        </div>
    </body>
    @endsection
</html>