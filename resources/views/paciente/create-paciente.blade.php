<!DOCTYPE html>
@extends('home')
@section('content')
    <div class="card-body">
        <form method="POST" action="{{ route('nutricionista.paciente.create') }}">
            @csrf

            <div class="mb-3">
                <x-jet-label value="{{ __('Nome') }}" />

                <x-jet-input class="{{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome"
                            :value="old('nome')" required autofocus autocomplete="nome" />
                <x-jet-input-error for="nome"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Email') }}" />

                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                            :value="old('email')" required />
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('CPF') }}" />

                <x-jet-input class="{{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="string" id="cpf" name="cpf"
                            :value="old('cpf')" required />
                <x-jet-input-error for="cpf"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Telefone 1') }}" />

                <x-jet-input class="{{ $errors->has('telefone_1') ? 'is-invalid' : '' }}" id="telefone1" type="text" name="telefone_1"
                            :value="old('telefone_1')" required />
                <x-jet-input-error for="telefone_1"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Telefone 2') }}" />

                <x-jet-input class="{{ $errors->has('telefone_2') ? 'is-invalid' : '' }}" id="telefone2" type="text" name="telefone_2"
                            :value="old('telefone_2')" required />
                <x-jet-input-error for="telefone_2"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Sexo') }}" />

                <div class="flex justify-center">
                    <div class="mb-3 xl:w-96">
                        <select id="seleciona-sexo" class="{{ $errors->has('sexo-select') ? 'is-invalid' : '' }} form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                            border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="sexo-select" required>
                            <option selected value="masculino">Masculino</option>
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
                                :value="old('obs')"/>
                <x-jet-input-error for="obs"></x-jet-input-error>
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
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/'">Início</button>

                    <x-jet-button name="Cadastro" class="btn btn-outline-secondary">
                        {{ __('Cadastrar') }}
                    </x-jet-button>
                </div>
            </div>
        </form>
    </div> 

<script>
    $(document).ready(function($) {
        $('#cpf').mask('000.000.000-00');
        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
        $('#telefone1').mask(SPMaskBehavior, spOptions);
        $('#telefone2').mask(SPMaskBehavior, spOptions);
    });
    
    document.getElementById("seleciona-sexo").addEventListener("change", (event) => {
        let valorSelectSexo = document.getElementById("seleciona-sexo").value;
        if(valorSelectSexo == "outro"){
            document.getElementById("input-sexo").required = true;
            document.getElementById("input-sexo").style.display = "";
        } else {
            document.getElementById("input-sexo").required = false;
            document.getElementById("input-sexo").style.display = "none";
        }
    });
</script>   
@endsection