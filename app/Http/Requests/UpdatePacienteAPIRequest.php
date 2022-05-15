<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdatePacienteAPIRequest extends FormRequest
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
            'nome'          => ['required', 'string', 'min:5', 'max:255'],
            'telefone_1'    => ['required', 'celular_com_ddd'],
            'telefone_2'    => ['nullable', 'celular_com_ddd'],
            'sexo-select'   => ["nullable", 'string', 'min:3', 'max:100'],
            'sexo-input'    => ['required_without:sexo-select', 'string', 'min:3', 'max:100'],
            'observacoes'   => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            "nome.required"                     => "O campo nome é obrigatório",
            'nome.min'                          => 'O campo Nome deve conter no mínimo :min caracteres',
            'nome.max'                          => 'O campo Nome deve conter no máximo :max caracteres',
            'sexo-select.min'                   => 'O campo Sexo deve conter no mínimo :min caracteres',
            'sexo-select.max'                   => 'O campo Sexo deve conter no máximo :max caracteres',
            'sexo-input.required_without'       => 'O campo Sexo é obrigatório',
            'sexo-input.min'                    => 'O campo Sexo deve conter no mínimo :min caracteres',
            'sexo-input.max'                    => 'O campo Sexo deve conter no máximo :max caracteres',
            'telefone_1.required'               => 'O campo Telefone/Celular 1 é obrigatório',
            'telefone_1.celular_com_ddd'        => 'O campo Telefone/Celular 1 inválido',
            'telefone_2.celular_com_ddd'        => 'O campo Telefone/Celular 2 inválido',
            'observacoes.min'                   => 'O campo Observações deve conter no mínimo :min caracteres',
            'observacoes.max'                   => 'O campo Observações deve conter no máximo :max caracteres',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'Os dados a seguir são invalidos',
            'errors' => $validator->errors()
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
