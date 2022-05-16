<!DOCTYPE html>
@extends('home')
@section('content')
    <div class="card-body">
        <form method="POST" action="{{ route('nutricionista.atualizar.paciente', $paciente->user->id) }}">
            @csrf

            <input type="hidden" name="id" value="{{$paciente->user->id}}" /> <br>
            <div class="mb-3">
                <x-jet-label value="{{ __('Nome') }}" />
                <input readonly class="form-control" type="text" placeholder="{{ $paciente->user->nome }}" >
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Email') }}" />
                <input readonly class="form-control" type="text" placeholder="{{ $paciente->user->email }}" >
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('CPF') }}" />
                <input readonly class="form-control" type="text" placeholder="{{ $paciente->user->cpf }}" >
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Telefone 1') }}" />
                <input readonly class="form-control" type="text" placeholder="{{ $paciente->user->telefone_1 }}" >
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Telefone 2') }}" />
                <input readonly class="form-control" type="text" placeholder = "{{ $paciente->user->telefone_2 }}" >
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Sexo') }}" />

                <div class="flex justify-center">
                    <div class="mb-3 xl:w-96">
                        <select id="seleciona-sexo" disabled class="{{ $errors->has('sexo-select') ? 'is-invalid' : '' }} form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                            border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="sexo-select" required>
                            <option selected value="{{ lcfirst( $paciente->sexo ) }}">{{ $paciente->sexo }}</option>
                        </select>
                    </div>
                    
                </div>

                
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Observações') }}" />
                <textarea readonly class="form-control" type="text" placeholder="{{ $paciente->observacoes }}"></textarea>
            </div>

            <div class="mb-0 rodape-form-registo">
                <div class="d-flex justify-content-end align-items-baseline">
                    <button style="margin-right: 10px" class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/listar/pacientes'">Listar</button>
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="document.location='/nutricionista/editar/paciente/{{$paciente->user->id}}'">Editar</button>
                </div>
            </div>
        </form>
    </div>
@endsection