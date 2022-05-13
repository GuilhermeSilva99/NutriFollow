<?php

namespace Database\Seeders;

use App\Models\RefeicaoNutricionista;
use Illuminate\Database\Seeder;

class RefeicaoNutricionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            RefeicaoNutricionista::factory(1)->create(["refeicao_id" => $i]);
        }
    }
}
