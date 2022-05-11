<?php

namespace Database\Factories;

use App\Models\ConsumoAgua;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsumoAgua>
 */
class ConsumoAguaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ConsumoAgua::class;

    public function definition()
    {
        return [
            "data" => Carbon::now(),
            "quantidade" => $this->faker->numberBetween(0, 6),
            "observacoes" => "obs",
            "paciente_id" => 1
        ];
    }
}
