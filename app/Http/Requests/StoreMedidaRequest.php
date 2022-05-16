<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedidaRequest extends FormRequest
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
            "data"          => ["required"],
            "altura"        => ["required", "numeric"],
            "peso"          => ["required", "numeric"],
            "cintura"       => ["required", "numeric"],
            "biceps"        => ["required", "numeric"],
            "ombro"         => ["required", "numeric"],
            "triceps"       => ["required", "numeric"],
            "peito"         => ["required", "numeric"],
            "coxa"          => ["required", "numeric"], 
            "panturrilha"   => ["required", "numeric"], 
            "quadril"       => ["required", "numeric"] 
        ];
    }

    public function messages()
    {
        return [
            'data.required'       => 'O campo data é obrigatório',
            'altura.required'     => 'O campo altura é obrigatório',
            'altura.numeric'      => 'O campo altura deve ser um número',
            'peso.required'       => 'O campo peso é obrigatório',
            'peso.numeric'        => 'O campo peso deve ser um número',
            'cintura.required'    => 'O campo cintura é obrigatório',
            'cintura.numeric'     => 'O campo cintura deve ser um número',
            'biceps.required'     => 'O campo biceps é obrigatório',
            'biceps.numeric'      => 'O campo biceps deve ser um número',
            'ombro.required'      => 'O campo ombro é obrigatório',
            'ombro.numeric'       => 'O campo ombro deve ser um número',
            'triceps.required'    => 'O campo triceps é obrigatório',
            'triceps.numeric'     => 'O campo triceps deve ser um número',
            'peito.required'      => 'O campo peito é obrigatório',
            'peito.numeric'       => 'O campo peito deve ser um número',
            'coxa.required'       => 'O campo coxa é obrigatório',
            'coxa.numeric'        => 'O campo coxa deve ser um número',
            'panturrilha.required'=> 'O campo panturrilha é obrigatório',
            'panturrilha.numeric' => 'O campo panturrilha deve ser um número',
            'quadril.required'    => 'O campo quadril é obrigatório',
            'quadril.numeric'     => 'O campo quadril deve ser um número',
        ];
    }
}
