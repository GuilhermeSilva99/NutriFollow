<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateConsumoAguaRequest extends FormRequest
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
            "quantidade"    => ["required", "min:0.1", "max:10", "numeric"],
            "observacoes"   => ["nullable", "min:1", "max:255"]
        ];
    }

    public function messages()
    {
        return [
            'quantidade.required'           => 'O campo quantidade é obrigatório',
            'quantidade.min'                => 'O campo quantidade deve ter no mínimo :min',
            'quantidade.max'                => 'O campo quantidade deve ter no máximo :max',
            'quantidade.numeric'            => 'O campo quantidade deve ser um número',
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
