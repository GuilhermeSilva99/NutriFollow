@extends('home')
@section('content')

    <body class="antialiased">
        <div class="card-body">
            {{-- <form method="POST" action="{{ route('nutricionista.cadastrar.exame.paciente') }}">
                @csrf
                <label for="pacientes" class="form-label">Selecione um Paciente</label>
                <select class="form-select" id="pacientes" name="paciente_id" required>
                    <option selected value="">Selecione Paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->user->nome }}</option>
                    @endforeach
                </select>               

                <button type="submit" class="btn btn-outline-secondary"
                    style="color: #fff; background-color: #233446; border-color: #233446; box-shadow: 0 0.125rem 0.25rem 0 rgba(35, 52, 70, 0.4)">Realizar
                    Consulta</button>
            </form> --}}
        </div>
    </body>
@endsection
