<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users'],
            'telefone1' => ['required', 'string', 'celular_com_ddd'],
            'telefone2' => ['nullable', 'celular_com_ddd'],
            'sexo-select' => ['string', 'min:3', 'max:100'],
            'sexo-input' => ['nullable', 'string', 'min:3', 'max:100'],
            'obs' => ['nullable', 'string', 'min:1', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'nome.required'             => 'O campo Nome é obrigatório',
            'nome.min'                  => 'O campo Nome deve conter no mínimo :min caracteres',
            'sexo-input.required_if'    => 'O campo Sexo é obrigatório',
            'telefone1.required'        => 'O campo Telefone/Celular 1 é obrigatório',
            'telefone1.celular_com_ddd' => 'O campo Telefone/Celular 1 inválido',
            'telefone2.celular_com_ddd' => 'O campo Telefone/Celular 2 inválido',
            'obs.min'                   => 'O campo Observações deve conter no mínimo :min caracteres',
            'password.required'         => 'O campo Senha é obrigatório',
            'password.min'              => 'O campo Senha deve conter no mínimo :min caracteres/digitos',
            'password.confirmed'        => 'Confirme a senha',
            'email.required'            => 'O campo Email é obrigatório',
            'email.unique'              => 'Já existe um usuário cadastrado no sistema com este email',
        ];
    }
}
