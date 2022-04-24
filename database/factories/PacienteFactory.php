<?php

namespace Database\Factories;

use App\Models\Nutricionista;
use App\Models\User;
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
    public function definition()
    {
        $user = User::create([
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'cadastro_aprovado' => rand(0,1) == 1,
            'tipo_usuario' => 2,
        ]);

        $nutri = Nutricionista::first();
        return [
            'sexo' => 'maculino',
            'observacoes' => null,
            'user_id' => $user->id,
            'nutricionista_id' => $nutri->id,
        ];
    }
}
