<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nutricionista;

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

        if(!$user)
        {
            $user = User::factory(1)->create()[0];
        }

        $nutri = Nutricionista::factory()->create();
        $nutri->user->cadastro_aprovado = 0;
        $nutri->user->save();
        User::destroy($nutri->user->id);
        //dd(User::onlyTrashed($nutri->user->id)->first());

        $this->browse(function (Browser $browser) use ($user, $nutri){
            $browser->loginAs($user)
                    ->visit('/admin/lista-nutricionistas-inativos')
                    ->assertSee('Lista de Nutricionistas Inativos')
                    ->press('@reativar-button-'.$nutri->user->id)
                    ->visit('/admin/lista-nutricionistas')
                    ->assertSee($nutri->user->nome);
        });
    }
}
