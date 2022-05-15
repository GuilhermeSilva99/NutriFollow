<!DOCTYPE html>
@extends('home')
@section('content')
    <div class="card-body">
        <form method="POST" action="{{route('dieta.cadastroDieta') }}">
            @csrf
            <div class="mb-3">
                <x-jet-label value="{{ __('Paciente') }}" />
                <select class="form-select" aria-label="Default select example" name="paciente_id" for="paciente_id" required>
                    @foreach ($pacientes as $paciente)
                        <option  value="{{$paciente->id}}" >{{$paciente->user->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Descrição') }}" />

                <x-jet-input class="{{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao"
                                :value="old('descricao')" required autofocus autocomplete="descricao" />
                <x-jet-input-error for="descricao"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Data de Início') }}" />

                <x-jet-input class="{{ $errors->has('data_inicio') ? 'is-invalid' : '' }}" type="date" name="data_inicio"
                                :value="old('data_inicio')" required autofocus autocomplete="descricao" />
                <x-jet-input-error for="data_inicio"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Data de Fim') }}" />

                <x-jet-input class="{{ $errors->has('data_fim') ? 'is-invalid' : '' }}" type="date" name="data_fim"
                                :value="old('data_fim')" required />
                <x-jet-input-error for="data_fim"></x-jet-input-error>
            </div>

            <div class="mb-0 rodape-form-registo">
                <div class="d-flex justify-content-end align-items-baseline">
                    <x-jet-button name="cadastrar" class="btn btn-outline-secondary">
                        {{ __('Cadastrar') }}
                    </x-jet-button>
                </div>
            </div>
        </form>
    </div>
@endsection