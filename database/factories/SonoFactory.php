<?php

namespace Database\Factories;

use App\Models\Sono;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sono>
 */
class SonoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Sono::class;

    private $statusAvaliacao = ["Bom", "Mediano", "Ruim"];

    public function definition()
    {
        return [
            "data" => Carbon::now(),
            "duracao" => "01:00",
            "avaliacao" => $this->faker->randomElement($this->statusAvaliacao),
            "observacoes" => "obs",
            "paciente_id" => 1
        ];
    }
}
