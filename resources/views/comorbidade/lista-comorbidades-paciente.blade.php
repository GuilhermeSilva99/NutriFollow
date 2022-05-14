@extends('home')
@section('content')
    <body class="antialiased">
        <h1>Comorbidades</h1>
        <div class="container">
            <table class="table table-responsive">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de diagnóstico</th>
                    <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comorbidades as $comorbidade)
                        <tr>
                            <th>{{ $comorbidade->nome }}</th>
                            <td>{{ $comorbidade->descricao }}</td>
                            <td>{{ date('d/m/Y', strtotime($comorbidade->data_diagnostico)) }}</td>
                            <td>
                                <div style="display: flex;">
                                    <form action="{{ route('nutricionista.editar.comorbidade.paciente', $comorbidade->id) }}" method="get" style="margin-right: 10px">
                                        @csrf
                                        <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Editar</button>
                                    </form>
                                    <form action="{{ route('nutricionista.deletar.comorbidade.paciente', $comorbidade->id) }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
        <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='{{ route('nutricionista.criar.comorbidade.paciente') }}'">Cadastar Novo</button>
    </body>
@endsection