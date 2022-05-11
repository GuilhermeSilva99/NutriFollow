<?php

namespace Database\Seeders;

use App\Models\Dieta;
use Illuminate\Database\Seeder;

class DietaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dieta::factory(1)->create();
    }
}
