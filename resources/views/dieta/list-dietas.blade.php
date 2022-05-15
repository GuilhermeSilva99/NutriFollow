@extends('home')
@section('content')
    <h1>Dietas</h1>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Data de inicio</th>
                <th scope="col">Data de fim</th>
                <th scope="col">Açoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dietas as $dieta)
                <tr>
                    <th>{{$dieta->descricao}}</th>
                    <td>{{ date('d/m/y', strtotime($dieta->data_inicio)) }}</td>
                    <td>{{ date('d/m/y', strtotime($dieta->data_fim)) }}</td>
                    <td>
                        <div style="display: flex;">
                            <form action="{{ route('dieta.view-dieta',[$dieta->id]) }}" method="get" style="margin-right: 10px">
                            @csrf
                                <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Detalhes</button>
                            </form>
                            <form method="get" action="{{ route('dieta.editarDieta', $dieta->id) }}" >
                                @csrf
                                <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Editar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach   
        </tbody>
    </table>
    <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/register-paciente'">Cadastar Novo</button>    
@endsection