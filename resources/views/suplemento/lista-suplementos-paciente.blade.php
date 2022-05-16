@extends('home')
@section('content')
    <div class="mx-auto" style="width: 680px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('nutricionista.listar.exame.paciente', $id) }}">Exame</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('nutricionista.listar.comorbidade.paciente', $id) }}">Cormobidade</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('nutricionista.listar.suplemento.paciente', $id)}}">Suplemento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">Medidas</a>
            </li>
        </ul>
    </div>

    <body class="antialiased">
        <div class="container">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Data início</th>
                        <th scope="col">Data fim</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suplementos as $suplemento)
                        <tr>
                            <th>{{ $suplemento->nome }}</th>
                            <td>{{ $suplemento->quantidade }}</td>
                            <td>{{ date('d/m/Y', strtotime($suplemento->data_inicio)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($suplemento->data_fim)) }}</td>
                            <td>
                                <div style="display: flex;">
                                    <form
                                        action="{{ route('nutricionista.editar.suplemento.paciente', $suplemento->id) }}"
                                        method="get" style="margin-right: 10px">
                                        @csrf
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-relatorios">Editar</button>
                                    </form>
                                    <form
                                        action="{{ route('nutricionista.deletar.suplemento.paciente', $suplemento->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-relatorios">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     
        <button class="btn btn-outline-secondary" type="button" id="button-addon1"
            onclick="document.location='{{ route('nutricionista.listar.pacientes') }}'">Listar Pacientes</button>
        <button class="btn btn-outline-secondary" type="button" id="button-addon1"
            onclick="document.location='{{ route('nutricionista.cadastrar.suplemento.paciente', $id) }}'">Cadastar Novo Suplemento</button>
    </body>
@endsection
