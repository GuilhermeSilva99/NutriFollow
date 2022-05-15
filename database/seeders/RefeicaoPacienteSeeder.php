<?php

namespace Database\Seeders;

use App\Models\RefeicaoPaciente;
use Illuminate\Database\Seeder;

class RefeicaoPacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i = 1; $i <= 10; $i++) {
            RefeicaoPaciente::factory(1)->create([  "refeicao_id" => $i,
                                                    "refeicao_referencia_id" => $i]);
        }
    }
}
