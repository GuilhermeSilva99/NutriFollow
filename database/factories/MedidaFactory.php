<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medida>
 */
class MedidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "data" => Carbon::now(),
            "altura" => number_format(1 + (1/mt_rand(1, 100)), 2), 
            "peso" => number_format(mt_rand(50, 100) + (1/mt_rand(1, 100)), 3), 
            "cintura" => mt_rand(50, 200), 
            "biceps" => mt_rand(50, 80), 
            "ombro" => mt_rand(50, 80), 
            "triceps" => mt_rand(50, 80), 
            "peito" => mt_rand(50, 200), 
            "coxa" => mt_rand(50, 80), 
            "panturrilha" => mt_rand(30, 50), 
            "quadril" => mt_rand(50, 200), 
            "paciente_id" => 1
        ];
    }
}
