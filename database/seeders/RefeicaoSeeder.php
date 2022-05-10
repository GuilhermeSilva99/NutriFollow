<?php

namespace Database\Seeders;

use App\Models\Refeicao;
use Illuminate\Database\Seeder;

class RefeicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Refeicao::factory(10)->create();
    }
}
