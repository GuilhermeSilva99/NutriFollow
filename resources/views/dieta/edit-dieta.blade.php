<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Dieta</title>
        <style>
            .bd-example-row {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid;
            }
        </style>
    </head>
    @extends('home')
    @section('content')
    <body class="antialiased">
        <br>
        <br>
        <br>
        <br>
        <div class="card-body">
            <form method="POST" action="{{ route('dieta.atualizarDieta', $dieta->id) }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Descrição') }}" />

                    <x-jet-input class="{{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="descricao"
                                 value="{{$dieta->descricao}}" required autofocus autocomplete="descricao" />
                    <x-jet-input-error for="descricao"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Data de Início') }}" />

                    <x-jet-input class="{{ $errors->has('data_inicio') ? 'is-invalid' : '' }}" type="date" name="data_inicio"
                                 value="{{$dieta->data_inicio}}" required autofocus autocomplete="descricao" />
                    <x-jet-input-error for="data_inicio"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Data de Fim') }}" />

                    <x-jet-input class="{{ $errors->has('data_fim') ? 'is-invalid' : '' }}" type="date" name="data_fim"
                                 value="{{$dieta->data_fim}}" required />
                    <x-jet-input-error for="data_fim"></x-jet-input-error>
                </div>

                <div class="mb-0 rodape-form-registo">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <x-jet-button name="cadastrar" class="btn btn-outline-secondary">
                            {{ __('Editar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>

            <form method="get" action="{{ route('dieta.dietas', $dieta->paciente_id) }}" >
                @csrf
                <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Voltar</button>
            </form>

        </div>
    </body>
    @endsection
    
</html>