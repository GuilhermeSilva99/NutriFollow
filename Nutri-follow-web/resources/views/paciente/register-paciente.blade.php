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

                            <x-jet-input class="{{ $errors->has('telefone1') ? 'is-invalid' : '' }}" type="text" name="telefone1"
                                        :value="old('telefone1')" required />
                            <x-jet-input-error for="telefone1"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Telefone 2') }}" />

                            <x-jet-input class="{{ $errors->has('telefone2') ? 'is-invalid' : '' }}" type="text" name="telefone2"
                                        :value="old('telefone2')" required />
                            <x-jet-input-error for="telefone2"></x-jet-input-error>
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