<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercicio>
 */
class ExercicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "tipo" => "exercicio",
            "duracao" => "01:00",
            "descricao" => "descricao",
            "data" => Carbon::now(),
            "paciente_id" => 1,
            "tipo_exercicio_id" => rand(1, 10)
        ];
    }
}
