<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateRefeicaoPacienteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "foto"              => ["nullable", "min:1", "max:255"],
            "observacoes"       => ["nullable", "min:1", "max:255"]
        ];
    }

    public function messages()
    {
        return [
            'foto.min'              => 'O campo foto deve ter no mínimo :min',
            'foto.max'              => 'O campo foto deve ter no máximo :max',
            'observacoes.min'       => 'O campo observação deve ter no mínimo :min',
            'observacoes.max'       => 'O campo observação deve ser no máximo :max',
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
