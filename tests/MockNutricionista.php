<?php

namespace Tests;

use App\Models\Nutricionista;
use App\Models\User;
use App\Services\GeradorCPF;
use Illuminate\Support\Str;

class MockNutricionista
{
    public static function criarNutricionista()
    {
        $usuario = User::create([
            'nome' => "nutricionista mock",
            'email' => "nutri" . Str::random(3) . "@email.com",
            'email_verified_at' => "2022-05-16 00:00:20",
            'telefone_1' => '(00) 00000-0000',
            'telefone_2' => '(00) 00000-0000',
            'cpf' => GeradorCPF::gerarCPF(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'cadastro_aprovado' => 1,
            'tipo_usuario' => 2,
        ]);

        return Nutricionista::create([
            'user_id' => $usuario->id,
            'crn' => Str::random(45),
            'uf' => 'PE'
        ]);
    }
}
