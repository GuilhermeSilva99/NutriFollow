<?php

namespace Database\Factories;

use App\Models\Refeicao;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefeicaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Refeicao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dia_da_semana' => "segunda",
            'descricao_refeicao' => "desc",
            'caloria' => 50.31,
            'horario' => 1,
            "nome_refeicao" => $this->faker->word(),
            "data" => now()->addDays(rand(1, 20)),
            "dieta_id" => 1
        ];
    }
}
