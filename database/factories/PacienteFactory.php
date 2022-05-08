<?php

namespace Database\Factories;

use App\Models\Nutricionista;
use App\Models\Paciente;
use App\Models\User;
use App\Services\GeradorCPF;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Paciente::class;

    public function definition()
    {
        $user = User::create([
            'nome' => "paciente",
            'email' => "paciente@email.com",
            'email_verified_at' => now(),
            'telefone_1' => '(00) 00000-0000',
            'telefone_2' => '(00) 00000-0000',
            'cpf' => GeradorCPF::gerarCPF(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'cadastro_aprovado' => 1,
            'tipo_usuario' => 3,
        ]);

        $nutri = Nutricionista::first();

        return [
            'sexo' => 'masculino',
            'observacoes' => null,
            'user_id' => $user->id,
            'nutricionista_id' => $nutri->id,
        ];
    }
}
