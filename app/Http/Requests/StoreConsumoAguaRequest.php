<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreConsumoAguaRequest extends FormRequest
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
            "data"          => ["required", "date_format:Y/m/d"],
            "quantidade"    => ["required", "min:1", "numeric"]
        ];
    }

    public function messages()
    {
        return [
            'data.required'                 => 'O campo data é obrigatório',
            'data.date_format'              => 'O campo data deve ser uma data no formato ano/mês/dia',
            'quantidade.required'           => 'O campo quantidade é obrigatório',
            'quantidade.min'                => 'O campo quantidade deve ter no mínimo :min',
            'quantidade.numeric'            => 'O campo quantidade deve ser um número',
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
