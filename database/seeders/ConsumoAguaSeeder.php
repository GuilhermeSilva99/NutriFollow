<?php

namespace Database\Seeders;

use App\Models\ConsumoAgua;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsumoAguaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConsumoAgua::factory(1)->create();
    }
}
