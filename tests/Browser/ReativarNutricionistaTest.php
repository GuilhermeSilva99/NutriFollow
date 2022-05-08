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

        $nutri = Nutricionista::factory()->create();
        $nutri->user->cadastro_aprovado = 0;
        $nutri->user->email_verified_at = "2022-05-05 01:24:40";
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
