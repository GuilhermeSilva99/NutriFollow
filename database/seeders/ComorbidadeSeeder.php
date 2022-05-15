<?php

namespace Database\Seeders;

use App\Models\Comorbidade;
use Illuminate\Database\Seeder;

class ComorbidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comorbidade::factory(1)->create();
    }
}
