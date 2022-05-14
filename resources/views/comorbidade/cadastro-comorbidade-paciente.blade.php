@extends('home')
@section('content')
    <body class="antialiased">
        <div class="card-body">
            <form method="POST" action="{{route('nutricionista.salvar.comorbidade.paciente') }}">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao">
                </div>
                <div class="mb-3">
                    <label for="data_diagnostico" class="form-label">Data de diagnóstico</label>
                    <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="data_diagnostico" name="data_diagnostico">
                </div>
                <div class="mb-3">
                    <label for="pacientes" class="form-label">Data de diagnóstico</label>
                    <select class="form-select" id="pacientes" name="paciente_id">
                        <option selected>Selecione Paciente</option>
                        @foreach ($pacientes as $paciente)
                            <option  value="{{$paciente->id}}" >{{$paciente->user->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-secondary" style="color: #fff; background-color: #233446; border-color: #233446; box-shadow: 0 0.125rem 0.25rem 0 rgba(35, 52, 70, 0.4)">Cadastrar</button>
            </form>
        </div>
    </body>
@endsection