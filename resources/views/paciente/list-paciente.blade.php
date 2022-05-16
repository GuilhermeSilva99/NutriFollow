<!DOCTYPE html>
@extends('home')
@section('content')
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes as $paciente)
                        <tr>
                            <th scope="row">{{$paciente->user->nome}}</th>
                            <td>
                                <form action="{{ route('nutricionista.listar.comorbidade.paciente', $paciente->id) }}" method="get">
                                    @csrf
                                    <button class="btn btn-outline-secondary" type="submit" id="button-dieta">Informações do paciente</button>
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
                            
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="/nutricionista/exibir/paciente/{{$paciente->user->id}}">Visualiza</a></li>
                                        <li><a class="dropdown-item" href="/nutricionista/editar/paciente/{{$paciente->user->id}}">Editar</a></li>
                                        <li><a class="dropdown-item" href="/nutricionista/paciente/senha/{{$paciente->user->id}}">Alterar Senha</a></li>
                                    </ul>
                                </div>
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
@endsection