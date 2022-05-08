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
            <form method="POST" action="{{ route('nutricionista.atualizar.paciente', $paciente->user->id) }}">
                @csrf

                <input type="hidden" name="id" value="{{$paciente->user->id}}"/> <br>
                <div class="mb-3">
                    <x-jet-label value="{{ __('Nome') }}" />

                    <x-jet-input class="{{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome"
                                value="{{$paciente->user->nome}}" required autofocus autocomplete="nome" />
                    <x-jet-input-error for="nome"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                value="{{$paciente->user->email}}" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('CPF') }}" />

                    <x-jet-input class="{{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="string" name="cpf"
                                value="{{$paciente->user->cpf}}" required />
                    <x-jet-input-error for="cpf"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Telefone 1') }}" />

                    <x-jet-input class="{{ $errors->has('telefone_1') ? 'is-invalid' : '' }}" type="text" name="telefone_1"
                                value="{{$paciente->user->telefone_1}}" required />
                    <x-jet-input-error for="telefone_1"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Telefone 2') }}" />

                    <x-jet-input class="{{ $errors->has('telefone_2') ? 'is-invalid' : '' }}" type="text" name="telefone_2"
                                value="{{$paciente->user->telefone_2}}" required />
                    <x-jet-input-error for="telefone_2"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Sexo') }}" />

                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <select id="seleciona-sexo" class="{{ $errors->has('sexo-select') ? 'is-invalid' : '' }} form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="sexo-select" required>
                                <option selected value={{lcfirst($paciente->sexo)}}>{{$paciente->sexo}}</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <x-jet-input id="input-sexo" placeholder="Digite o sexo do paciente" class="{{ $errors->has('sexo-input') ? 'is-invalid' : '' }}" style="display: none" type="text" name="sexo-input" :value="old('sexo-input')" />
                    </div>

                    <x-jet-input-error for="sexo"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Observações') }}" />

                    <x-jet-input class="{{ $errors->has('obs') ? 'is-invalid' : '' }}" type="text" name="obs"
                                 value="{{$paciente->observacoes}}"/>
                    <x-jet-input-error for="obs"></x-jet-input-error>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0 rodape-form-registo">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/listar/pacientes'">Listar</button>

                        <x-jet-button name="Editar" class="btn btn-outline-secondary">
                            {{ __('Editar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    @endsection
</html>