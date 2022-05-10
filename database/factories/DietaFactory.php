<?php

namespace Database\Factories;

use App\Models\Dieta;
use Illuminate\Database\Eloquent\Factories\Factory;

class DietaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dieta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descricao' => $this->faker->text(),
            'data_inicio' => now(),
            'data_fim' => now()->addDays(20),
            'paciente_id' => 1,
        ];
    }
}
