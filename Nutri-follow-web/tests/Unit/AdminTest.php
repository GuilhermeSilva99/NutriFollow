<?php

namespace Tests\Unit;

use App\Models\Nutricionista;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\Admin\AdministrarNutricionistasController;


class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function verificar_se_admin_desativa_nutricionista_corretamente()
    { 
        $nutri = Nutricionista::factory(1)->create()[0];
        $nutri->user->cadastro_aprovado = true;
        $nutri->save();

        $admin = new AdministrarNutricionistasController();
        $admin->inativar($nutri->user->id);

        $user = User::onlyTrashed()
                        ->where('id', $nutri->user->id)
                        ->first();

        $this->assertEquals(0, $user->cadastro_aprovado);
    }
}
