<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreRefeicaoRequest extends FormRequest
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
            "nome_refeicao"             => ["required", "min:1", "max:45",],
            "descricao_refeicao"        => ["required", "min:1", "max:255"],
            "caloria"                   => ["required", "numeric", "min:1", "max:10000"],
            "horario"                   => ["required", "date_format:H:i"],
            "data"                      => ["required", "date_format:Y/m/d"],
            "dieta_id"                  => ["required", "numeric"],
            "dia_da_semana"             => ["nullable", "min:1", "max:45"],
            "foto"                      => ["nullable", "min:1", "max:255"],
            "observacoes"               => ["nullable", "min:1", "max:255"],
        ];
    }

    public function messages()
    {
        return [
            "nome_refeicao.required"        => "O campo nome da refeição é obrigatório",
            "nome_refeicao.min"             => "O campo nome da refeição deve ter no mínimo :min caracteres",
            "nome_refeicao.max"             => "O campo nome da refeição deve ter no máximo :max caracteres",
            "descricao_refeicao.required"   => "O campo descrição da refeição é obrigatório",
            "descricao_refeicao.min"        => "O campo descrição da refeição deve ter no mínimo :min caracteres",
            "descricao_refeicao.max"        => "O campo descrição da refeição deve ter no máximo :max caracteres",
            "caloria.required"              => "O campo caloria é obrigatório",
            "caloria.min"                   => "O campo caloria deve ter no mínimo :min calorias",
            "caloria.max"                   => "O campo caloria deve ter no máximo :max calorias",
            "horario.required"              => "O campo horário é obrigatório",
            "horario.date_format"           => "O campo horário deve ser no formato Hora:Minuto",
            "data.required"                 => "O campo data é obrigatório",
            "data.date_format"              => "O campo data deve ser uma data no formato ano/mês/dia",
            "dieta_id.required"             => "A dieta é obrigatória",
            "dieta_id.numeric"              => "Dieta inválida",
            "dia_da_semana.required"        => "O campo dia da semana é obrigatório",
            "dia_da_semana.min"             => "O campo dia da semana deve ter no mínimo :min caracteres",
            "dia_da_semana.max"             => "O campo dia da semana deve ter no máximo :max caracteres",
            'foto.min'                      => 'O campo foto deve ter no mínimo :min caracteres',
            'foto.max'                      => 'O campo foto deve ter no máximo :max caracteres',
            'observacoes.min'               => 'O campo observação deve ter no mínimo :min caracteres',
            'observacoes.max'               => 'O campo observação deve ser no máximo :max caracteres',
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
