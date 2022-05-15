@extends('home')
@section('content')
    <body class="antialiased">
        <div class="card-body">
            <form method="POST" action="{{route('nutricionista.atualizar.exame.paciente', $exame->id ) }}">
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $exame->nome }}" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $exame->descricao }}" required>
                </div>
                <div class="mb-3">
                    <label for="data_diagnostico" class="form-label">Data de Realização</label>
                    <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="data_realizacao" name="data_realizacao" value="{{ $exame->data_realizacao }}" required>
                </div>
                <button type="submit" class="btn btn-outline-secondary" 
                    style="color: #fff; background-color: #233446; border-color: 
                    #233446; box-shadow: 0 0.125rem 0.25rem 0 rgba(35, 52, 70, 0.4)">Editar</button>
            </form>
        </div>
    </body>
@endsection