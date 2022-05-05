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
            <form method="POST" action="{{route('nutricionista.paciente.atualizar.senha', $paciente->user->id) }}">
                @csrf

                <input type="hidden" name="id" value="{{$paciente->user->id}}" /> <br> 
                <div class="mb-3">
                    <x-jet-label value="{{ __('Nome') }}" />

                    <x-jet-input class="{{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome"
                        value="{{$paciente->user->nome}}"  required autofocus autocomplete="nome"  readonly/>
                    <x-jet-input-error for="nome"></x-jet-input-error>
                </div> 

                <div class="mb-3">
                    <x-jet-label value="{{ __('Senha') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirmar Senha') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
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

                        <x-jet-button name="Resetar" class="btn btn-outline-secondary">
                            {{ __('Resetar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    @endsection
    
</html>