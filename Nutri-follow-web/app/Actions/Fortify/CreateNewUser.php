<?php

namespace App\Actions\Fortify;

use App\Models\Nutricionista;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cpf' => ['required', 'string', 'size:11'],
            'telefone1' => ['required', 'string', 'size:11'],
            'telefone2' => ['required', 'string', 'size:11'],
            'crn' => ['required', 'string', 'size:45'],
            'uf' => ['required', 'string', 'size:2'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $usuario = User::create([
            'nome' => $input['nome'],
            'email' => $input['email'],
            'cpf' => $input['cpf'],
            'telefone_1' => $input['telefone1'],
            'telefone_2' => $input['telefone2'],
            'tipo_usuario' => 2,
            'password' => Hash::make($input['password']),
        ]);

        Nutricionista::create([
            'crn' => $input['crn'],
            'uf' => $input['uf'],
            'users_id' => $usuario->id,
        ]);

        return $usuario;
    }
}
