<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nutricionista;
use Tests\MockNutricionista;

class ReativarNutricionistaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testReativarNutricionistaInativo()
    {
        $user = User::where('tipo_usuario', 1)->first();

        $nutri = MockNutricionista::criarNutricionista();
        $nutri->user->cadastro_aprovado = 0;
        $nutri->user->save();

        Nutricionista::destroy($nutri->id);
        User::destroy($nutri->user->id);

        $this->browse(function (Browser $browser) use ($user, $nutri) {
            $browser->loginAs($user)
                ->visit('/admin/listar/nutricionistas-inativos')
                ->assertSee('Lista de Nutricionistas Inativos')
                ->press('@reativar-button-' . $nutri->user->id)
                ->visit('/admin/listar/nutricionistas')
                ->assertSee($nutri->user->nome);
        });
    }
}
