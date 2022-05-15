@extends('home')
@section('content')
    <body class="antialiased">
        <div class="mx-auto" style="width: 680px;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <form method="POST" action="{{route('nutricionista.cadastrar.exame.paciente') }}">
                        @csrf
                        <input type="hidden" name="paciente_id" value="{{$id}}"/>
                        <div class="mb-3">
                            <button type="submit" class="nav-link active">Exame</button>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="/nutricionista/paciente/agua/{{$id}}">Relatório de Consumo de Água</a>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="/nutricionista/paciente/sono/{{$id}}" >Relatório de qualidade do Sono</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('nutricionista.salvar.exame.paciente') }}">
                @csrf
                <input type="hidden" name="paciente_id" value="{{$id}}"/> <br>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Exame</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-">Descrição</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="data_realizacao" class="form-label">Data de Realização</label>
                    <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="data_realizacao" name="data_realizacao" required>
                </div>
                <button type="submit" class="btn btn-outline-secondary" 
                style="color: #fff; background-color: #233446; border-color: #233446; box-shadow: 0 0.125rem 0.25rem 0 rgba(35, 52, 70, 0.4)">Cadastrar</button>
            </form>
        </div>
    </body>
@endsection