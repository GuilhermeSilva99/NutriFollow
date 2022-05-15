<!DOCTYPE html>
@extends('home')
@section('content')
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
            
            <div class="mb-0 rodape-form-registo">
                <div class="d-flex justify-content-end align-items-baseline">
                    <button style="margin-right: 10px;" class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/listar/pacientes'">Listar</button>

                    <x-jet-button name="Resetar" class="btn btn-outline-secondary">
                        {{ __('Resetar') }}
                    </x-jet-button>
                </div>
            </div>
        </form>
    </div>
@endsection