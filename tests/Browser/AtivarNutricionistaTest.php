<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nutricionista;

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

        $nutri = Nutricionista::factory()->create();
        $nutri->user->cadastro_aprovado = 0;
        $nutri->user->save();

        $this->browse(function (Browser $browser) use ($user, $nutri) {
            $browser->loginAs($user)
                ->visit('/admin/home')
                ->assertSee($nutri->user->nome)
                ->press('@aprovar-button-' . $nutri->user->id)
                ->visit('/admin/listar/nutricionistas')
                ->assertSee($nutri->user->nome);
        });
    }
}
