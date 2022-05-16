<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Tests\MockNutricionista;

class DesativarNutricionistaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDesativarNutricionistaAtivo()
    {
        $admin = User::where('tipo_usuario', 1)->first();

        $nutri = MockNutricionista::criarNutricionista();

        $this->browse(function (Browser $browser) use ($admin, $nutri) {
            $browser->loginAs($admin)
                ->visit('/admin/listar/nutricionistas')
                ->assertSee($nutri->user->nome)
                ->press('@desativar-button-' . $nutri->user->id)
                ->visit('/admin/listar/nutricionistas-inativos')
                ->assertSee($nutri->user->nome);
        });
    }
}
