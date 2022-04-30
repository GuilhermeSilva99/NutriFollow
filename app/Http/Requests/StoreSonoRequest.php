<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreSonoRequest extends FormRequest
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
            'duracao' => ['required', 'date_format:H:i'],
            'avaliacao' => ['required', 'string', 'min:3', 'max:100']
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
            'avaliacao.min'                 => 'O campo avaliação deve ter no máximo :min caracteres',
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
