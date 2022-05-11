<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'min:5', 'max:255'],
            'cpf' => ['required', 'string', 'cpf'],
            'telefone_1' => ['required', 'string', 'celular_com_ddd'],
            'telefone_2' => ['nullable', 'celular_com_ddd'],
            'sexo-select' => ['string', 'min:3', 'max:100'],
            'sexo-input' => ['nullable', 'string', 'min:3', 'max:100'],
            'obs' => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required'                 => 'O campo Nome é obrigatório',
            'nome.min'                      => 'O campo Nome deve conter no mínimo :min caracteres',
            'sexo-input.required_if'        => 'O campo Sexo é obrigatório',
            'telefone_1.required'           => 'O campo Telefone/Celular 1 é obrigatório',
            'telefone_1.celular_com_ddd'    => 'O campo Telefone/Celular 1 inválido',
            'telefone_2.celular_com_ddd'    => 'O campo Telefone/Celular 2 inválido',
            'obs.min'                       => 'O campo Observações deve conter no mínimo :min caracteres',
            'email.required'                => 'O campo Email é obrigatório',
        ];
    }
}
