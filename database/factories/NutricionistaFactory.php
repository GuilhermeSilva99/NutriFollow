<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Nutricionista;
use App\Services\GeradorCPF;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nutricionista>
 */
class NutricionistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Nutricionista::class;

    public function definition()
    {
        $usuario = User::create([
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'telefone_1' => '(00) 00000-0000',
            'telefone_2' => '(00) 00000-0000',
            'cpf' => GeradorCPF::gerarCPF(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'cadastro_aprovado' => 1,
            'tipo_usuario' => 2,
        ]);

        return [
            'user_id' => $usuario->id,
            'crn' => Str::random(45),
            'uf' => 'PE'
        ];
    }
}
