<?php

namespace Database\Factories;

use App\Models\Comorbidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsumoAgua>
 */
class ComorbidadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comorbidade::class;

    public function definition()
    {
        return [
            "nome" => "Obesidade",
            "descricao" => "ta muito gordo",
            "data_diagnostico" => "2022-06-02",
            "paciente_id" => 1
        ];
    }
}
