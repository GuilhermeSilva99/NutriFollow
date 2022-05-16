<!DOCTYPE html>
@extends('home')
@section('content')
    <div class="card-body">
        <div class="card-body">
        <h1>Lista de Refeições</h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">Nome da refeicao</th>
                    <th scope="col">Caloria</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Descrição da refeição</th>
                    <th scope="col">Açoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($refeicoes as $refeicao)
                    <tr>
                        <th>{{$refeicao->nome_refeicao}}</th>
                        <td>{{$refeicao->caloria}}</td>
                        <td>{{$refeicao->horario}}</td>
                        <td>{{$refeicao->descricao_refeicao}}</td>
                        <td>
                            <form method="get" action="{{ route('refeicao.editarRefeicao', $refeicao->id) }}" >
                                @csrf
                                <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Editar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach   
            </tbody>
        </table>
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
@endsection