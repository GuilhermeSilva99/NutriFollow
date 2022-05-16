@extends('home')
@section('content')
    <div class="card-body">
        <form method="POST" action="{{route('nutricionista.atualizar.comorbidade.paciente', $comorbidade->id ) }}">
            @method("PUT")
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $comorbidade->nome }}">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $comorbidade->descricao }}">
            </div>
            <div class="mb-3">
                <label for="data_diagnostico" class="form-label">Data de diagnóstico</label>
                <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="data_diagnostico" name="data_diagnostico" value="{{ $comorbidade->data_diagnostico }}">
            </div>
            <button type="submit" class="btn btn-outline-secondary" 
                style="color: #fff; background-color: #233446; border-color: 
                #233446; box-shadow: 0 0.125rem 0.25rem 0 rgba(35, 52, 70, 0.4)">Editar</button>
        </form>
    </div>
@endsection