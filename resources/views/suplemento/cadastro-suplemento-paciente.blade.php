@extends('home')
@section('content')

    <body class="antialiased">

        <div class="card-body">
            <form method="POST" action="{{ route('nutricionista.salvar.suplemento.paciente') }}">
                @csrf
                <input type="hidden" name="paciente_id" value="{{ $id }}" /> <br>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do suplemento</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="form-">Quantidade</label>
                    <input type="text" class="form-control" id="quantidade" name="quantidade" required>
                </div>
                <div class="mb-3">
                    <label for="data_inicio" class="form-label">Data início</label>
                    <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="data_inicio"
                        name="data_inicio" required>
                </div>
                <div class="mb-3">
                    <label for="data_fim" class="form-label">Data fim</label>
                    <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="data_fim"
                        name="data_fim" required>
                </div>
                <button class="btn btn-outline-secondary" type="button" id="button-addon1"
                    onclick="document.location='{{ route('nutricionista.listar.suplemento.paciente', $id) }}'">Listar Suplementos</button>
                <button type="submit" class="btn btn-outline-secondary"
                    style="color: #fff; background-color: #233446; border-color: #233446; box-shadow: 0 0.125rem 0.25rem 0 rgba(35, 52, 70, 0.4)">Cadastrar</button>
            </form>
        </div>
    </body>
@endsection
