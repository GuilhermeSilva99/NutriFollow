<?php

namespace Database\Seeders;

use App\Models\Refeicao;
use Carbon\Carbon;
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
        for ($i = 1; $i <= 10; $i++) {
            Refeicao::factory(1)->create(["data" => Carbon::now()->addDays($i)]);
        }
    }
}
