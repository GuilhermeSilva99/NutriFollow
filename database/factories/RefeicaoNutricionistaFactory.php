<?php

namespace Database\Factories;

use App\Models\RefeicaoNutricionista;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefeicaoNutricionistaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefeicaoNutricionista::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'refeicao_id' => rand(1, 10),
            'nutricionista_id' => 1
        ];
    }
}
