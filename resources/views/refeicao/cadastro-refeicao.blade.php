<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Cadastrar Refeição') }}
        </h2>
    </x-slot>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('refeicao.cadastroRefeicao') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Nome') }}" />

                    <x-jet-input class="{{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome_refeicao"
                                 :value="old('nome')" required autofocus autocomplete="nome" />
                    <x-jet-input-error for="nome_refeicao"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Descrição') }}" />

                    <x-jet-input class="{{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao_refeicao"
                                 :value="old('descricao')" required autofocus autocomplete="descricao" />
                    <x-jet-input-error for="descricao_refeicao"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Calorias') }}" />

                    <x-jet-input class="{{ $errors->has('calorias') ? 'is-invalid' : '' }}" type="number" name="caloria"
                                 :value="old('calorias')" required />
                    <x-jet-input-error for="caloria"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Horário') }}" />

                    <x-jet-input class="{{ $errors->has('horario') ? 'is-invalid' : '' }}" type="time" name="horario"
                                 :value="old('horario')" required />
                    <x-jet-input-error for="horario"></x-jet-input-error>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <x-jet-button>
                            {{ __('Cadastrar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-app-layout>