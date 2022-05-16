<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nutricionista;
use Tests\MockNutricionista;

class AtivarNutricionistaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAtivarNutricionista()
    {
        $user = User::where('tipo_usuario', 1)->first();

        $nutricionista = MockNutricionista::criarNutricionista();
        $nutricionista->user->cadastro_aprovado = 0;
        $nutricionista->user->save();

        $this->browse(function (Browser $browser) use ($user, $nutricionista) {
            $browser->loginAs($user)
                ->visit('/admin/home')
                ->assertSee($nutricionista->user->nome)
                ->press('@aprovar-button-' . $nutricionista->user->id)
                ->visit('/admin/listar/nutricionistas')
                ->assertSee($nutricionista->user->nome);
        });
    }
}
