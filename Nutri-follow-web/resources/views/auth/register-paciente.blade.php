<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
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


                <div class="mb-3">
                    <x-jet-label value="{{ __('Observações') }}" />

                    <x-jet-input class="{{ $errors->has('obs') ? 'is-invalid' : '' }}" type="text" name="obs"
                                 :value="old('obs')" required />
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

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Já é cadastrado?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Cadastra-se') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>