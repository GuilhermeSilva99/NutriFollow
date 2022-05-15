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

                            <x-jet-input class="{{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="string" id="cpf" name="cpf"
                                        :value="old('cpf')" required />
                            <x-jet-input-error for="cpf"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Telefone 1') }}" />

                            <x-jet-input class="{{ $errors->has('telefone_1') ? 'is-invalid' : '' }}" type="text" id="telefone1" name="telefone_1"
                                        :value="old('telefone_1')" required />
                            <x-jet-input-error for="telefone_1"></x-jet-input-error>
                        </div>
                        <div class="mb-3">

                            <x-jet-input class="{{ $errors->has('telefone_2') ? 'is-invalid' : '' }}" type="text" id="telefone2" name="telefone_2"
                                        :value="old('telefone_2')" />
                            <x-jet-input-error for="telefone_2"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('CRN') }}" />

                            <x-jet-input class="{{ $errors->has('crn') ? 'is-invalid' : '' }}" type="text" name="crn"
                                        :value="old('crn')" required />
                            <x-jet-input-error for="crn"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('UF') }}" />

                            <div class="flex justify-center">
                                <div class="mb-3 xl:w-96">
                                    <select class="{{ $errors->has('uf') ? 'is-invalid' : '' }} form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                                        border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="uf" required>
                                        <option selected value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>

                            <x-jet-input-error for="crn"></x-jet-input-error>
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

                        <div class="mb-0 rodape-form-registo">
                            <div class="d-flex justify-content-end align-items-baseline">
                                <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                                    {{ __('Já é cadastrado?') }}
                                </a>

                                <x-jet-button name="Cadastro" class="button rounded-pill">
                                    {{ __('Cadastrar-se') }}
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
</script>