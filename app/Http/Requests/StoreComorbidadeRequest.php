<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComorbidadeRequest extends FormRequest
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
            "nome"              => ["required", "min:1", "max:255"],
            "descricao"         => ["required", "min:1", "max:255"],
            "data_diagnostico"  => ["required", "date"],
            "paciente_id"       => ["required", "numeric"]
        ];
    }

    public function messages()
    {
        return [
            'data_diagnostico.required'     => 'O campo data de diagnóstico é obrigatório',
            'data_diagnostico.date'         => 'O campo data de diagnóstico deve ser uma data valida',
            'nome.min'                      => 'O campo nome deve ter no mínimo :min caracteres',
            'nome.max'                      => 'O campo nome deve ter no máximo :max caracteres',
            'descricao.min'                 => 'O campo descrição deve ter no mínimo :min caracteres',
            'descricao.max'                 => 'O campo descrição deve ter no máximo :max caracteres',
            'paciente_id.numeric'           => 'Paciente inválido',
            'paciente_id.requited'          => 'O paciente é obrigatório',
        ];
    }
}
