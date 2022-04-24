<x-guest-layout>
    <div class="row cards-login">
        <div class="col-md-6 bg-image cards-login-background">
            
        </div>
        <div class="col-md-6 bg-white">
            <div class="card card-cadastro col-md-6 mx-auto card-registro-posicao">
                <div class="mb-3 texto-topo-card-registo h3">
                    <a class="text-muted text-decoration-none">
                        {{ __('NutriFollow') }}
                    </a>
                </div>
                <x-jet-validation-errors class="mb-3" />

                <div class="card-body">
                    <form method="POST" action="{{ route('paciente.create') }}">
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

                            <x-jet-input class="{{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="string" name="cpf"
                                        :value="old('cpf')" required />
                            <x-jet-input-error for="cpf"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Telefone 1') }}" />

                            <x-jet-input class="{{ $errors->has('telefone_1') ? 'is-invalid' : '' }}" type="text" name="telefone_1"
                                        :value="old('telefone_1')" required />
                            <x-jet-input-error for="telefone_1"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Telefone 2') }}" />

                            <x-jet-input class="{{ $errors->has('telefone_2') ? 'is-invalid' : '' }}" type="text" name="telefone_2"
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
                                        <option value="mulher">Feminino</option>
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
                                         :value="old('obs')" required />
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
                                <a class="text-muted me-3 text-decoration-none" href="{{ route('dashboard') }}">
                                    {{ __('Voltar') }}
                                </a>

                                <x-jet-button name="Cadastro" class="button rounded-pill">
                                    {{ __('Cadastrar') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
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