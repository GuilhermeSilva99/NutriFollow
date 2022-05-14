<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar Refeição</title>
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
            <form method="POST" action="{{ route('refeicao.atualizarRefeicao', $refeicao->id) }}">

                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Nome') }}" />

                    <x-jet-input class="{{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome_refeicao"
                                    value="{{$refeicao->nome_refeicao}}" required autofocus autocomplete="nome" />
                    <x-jet-input-error for="nome_refeicao"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Descrição') }}" />

                    <x-jet-input class="{{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao_refeicao"
                                    value="{{$refeicao->descricao_refeicao}}" required autofocus autocomplete="descricao" />
                    <x-jet-input-error for="descricao_refeicao"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Calorias') }}" />

                    <x-jet-input class="{{ $errors->has('calorias') ? 'is-invalid' : '' }}" type="number" name="caloria"
                                    value="{{$refeicao->caloria}}" required />
                    <x-jet-input-error for="caloria"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Horário') }}" />

                    <x-jet-input class="{{ $errors->has('horario') ? 'is-invalid' : '' }}" type="time" name="horario"
                                    value="{{$refeicao->horario}}" required />
                    <x-jet-input-error for="horario"></x-jet-input-error>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <x-jet-button>
                            {{ __('Editar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>

            <form method="get" action="{{ route('dieta.view-dieta', $refeicao->dieta_id) }}" >
                @csrf
                <button class="btn btn-outline-secondary" type="submit" id="button-relatorios">Voltar</button>
            </form>

        </div>
    </body>
    @endsection
    
</html>