<x-guest-layout>
    <div class="row cards-login">
        <div class="col-md-6 bg-image cards-login-background">
            
        </div>
        <div class="col-md-6 bg-white">
            <div class="card col-md-6 mx-auto card-posicao">
                <div class="mb-3 texto-topo-card h3">
                    <a class="text-muted text-decoration-none">
                        {{ __('NutriFollow') }}
                    </a>
                </div>
                <div class="card-body">

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <x-jet-label value="{{ __('Email') }}" />

                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                        name="email" :value="old('email')" required />
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Password') }}" />

                            <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                        name="password" required autocomplete="current-password" />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <label class="custom-control-label" for="remember_me">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-0 rodape-form">
                            <div class="d-flex justify-content-end align-items-baseline">
                                @if (Route::has('password.request'))
                                    <a class="text-muted me-3" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                                <x-jet-button class="button rounded-pill">
                                    {{ __('Log in') }}
                                </x-jet-button>
                            </div>
                        </div>
                        <div class="mb-0">
                            <div class="d-flex justify-content-end rodape-login">
                                <a class="text-muted me-3" href="{{ route('register') }}">
                                    {{ __('Não possui uma conta? CADASTRE-SE') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>