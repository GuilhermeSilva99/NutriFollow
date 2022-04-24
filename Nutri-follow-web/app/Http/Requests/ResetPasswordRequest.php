<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'password.required'         => 'O campo Senha é obrigatório',
            'password.min'              => 'O campo Senha deve conter no mínimo :min caracteres/digitos',
            'password.max'              => 'O campo Senha deve conter no máximo :max caracteres/digitos',
            'password.confirmed'        => 'A confirmação de senha não confere',
        ];
    }
}
