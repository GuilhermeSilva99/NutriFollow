<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreExercicioRequest extends FormRequest
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
            "tipo"                  => ["required_without:tipo_exercicio_id", "nullable", "string", "min:3", "max:255"],
            "duracao"               => ["required", "date_format:H:i"],
            "descricao"             => ["required", "string", "min:3", "max:255"],
            "data"                  => ["required", "date_format:Y/m/d"],
            "observacoes"           => ["nullable", "min:1", "max:255"],
            "tipo_exercicio_id"     => ["nullable", "numeric"]
        ];
    }

    public function messages()
    {
        return [
            'data.required'                 => 'O campo data é obrigatório',
            'data.date_format'              => 'O campo data deve ser uma data no formato ano/mês/dia',
            'duracao.required'              => 'O campo duração é obrigatório',
            'duracao.date_format'           => 'O campo duração deve ser no formato Hora:Minuto',
            'descricao.required'            => 'O campo descricao é obrigatório',
            'descricao.min'                 => 'O campo descricao deve ter no mínimo :min',
            'descricao.max'                 => 'O campo descricao deve ser no máximo :max',
            'tipo.required_without'         => 'O campo tipo deve ser obrigatório',
            'tipo.min'                      => 'O campo tipo deve ter no mínimo :min',
            'tipo.max'                      => 'O campo tipo deve ser no máximo :max',
            "tipo_exercicio_id.numeric"     => "Tipo de exercício inválido",
            'observacoes.min'               => 'O campo observações deve ter no mínimo :min caracteres',
            'observacoes.max'               => 'O campo observações deve ter no máximo :max caracteres'
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
