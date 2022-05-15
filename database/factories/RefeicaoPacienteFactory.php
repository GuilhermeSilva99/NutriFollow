<?php

namespace Database\Factories;

use App\Models\RefeicaoPaciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefeicaoPaciente>
 */
class RefeicaoPacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'foto' => "https://picsum.photos/400/300?random=".mt_rand(1, 55000),
            'observacoes' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'refeicao_id' => rand(1, 10),
            'refeicao_referencia_id' => rand(1, 10),
            'paciente_id' => 1,
        ];
    }
}
