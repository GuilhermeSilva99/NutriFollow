<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <div class="mb-3 small text-muted">
                {{ __('Obrigado por confirmar a sua conta! A partir de agora os seus dados serão validados para o seu cadastro ser validado ou não.') }}
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <form method="POST" action="/logout">
                    @csrf

                    <div>
                        <x-jet-button type="submit">
                            {{ __('Sair') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>