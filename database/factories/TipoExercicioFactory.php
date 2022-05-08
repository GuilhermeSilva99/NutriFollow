<?php

namespace Database\Factories;

use App\Models\TipoExercicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoExercicio>
 */
class TipoExercicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TipoExercicio::class;

    private $tiposExercicios = [
        "Artes marcias", "Caminhada", "Corrida", "Aeróbica", "Bicicleta", "Ginástica",
        "Dança", "Flexões", "Futebol", "Voleibol"
    ];

    public function definition()
    {
        return [
            "nome" => $this->faker->randomElement($this->tiposExercicios),
        ];
    }
}
