<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateSonoRequest extends FormRequest
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
            'duracao'       => ['required', 'date_format:H:i'],
            'avaliacao'     => ['required', 'string', 'min:3', 'max:100'],
            "observacoes"   => ["nullable", "min:1", "max:255"]
        ];
    }

    public function messages()
    {
        return [
            'duracao.required'              => 'O campo duração é obrigatório',
            'duracao.date_format'           => 'O campo duração deve ser no formato Hora:Minuto',
            'avaliacao.required'            => 'O campo avaliação é obrigatório',
            'avaliacao.required'            => 'O campo avaliação deve ser uma string',
            'avaliacao.min'                 => 'O campo avaliação deve ter no mínimo :min caracteres',
            'avaliacao.max'                 => 'O campo avaliação deve ter no máximo :min caracteres',
            'observacoes.min'               => 'O campo observações deve ter no mínimo :min',
            'observacoes.max'               => 'O campo observações deve ter no máximo :max'
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
