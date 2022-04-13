<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pacientes</title>
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
            <form method="POST" action="{{ route('paciente.edit') }}">
                @csrf

                <input type="hidden" name="id" value="{{$user->id}}" /> <br>
                <div class="mb-3">
                    <x-jet-label value="{{ __('Nome') }}" />
                    <input class="form-control" type="text" placeholder={{$user->nome}} readonly>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />
                    <input class="form-control" type="text" placeholder={{$user->email}} readonly>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('CPF') }}" />
                    <input class="form-control" type="text" placeholder={{$user->cpf}} readonly>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Telefone 1') }}" />
                    <input class="form-control" type="text" placeholder={{$user->telefone_1}} readonly>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Telefone 2') }}" />
                    <input class="form-control" type="text" placeholder={{$user->telefone_2}} readonly>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Sexo') }}" />

                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <select id="seleciona-sexo" disabled class="{{ $errors->has('sexo-select') ? 'is-invalid' : '' }} form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="sexo-select" required>
                                <option selected value={{lcfirst($paciente->sexo)}}>{{$paciente->sexo}}</option>
                            </select>
                        </div>
                        
                    </div>

                    
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Observações') }}" />
                    <textarea class="form-control" type="text" placeholder={{$paciente->observacoes}} readonly></textarea>
                </div>

                <div class="mb-0 rodape-form-registo">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('dashboard') }}">
                            {{ __('Voltar') }}
                        </a>

                        <x-jet-button name="Editar" class="button rounded-pill">
                            {{ __('Editar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    @endsection
</html>