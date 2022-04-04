<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CadastroNutricionistaTest extends DuskTestCase
{

    public function testCadastrarNutricionista()
    {
        $usuarioInfo = [
            'nome' => "Usuario teste",
            'email' => "usuario@email.com",
            'cpf' => "11111111111",
            'telefone_1' => "00000000000",
            'telefone_2' => "00000000000",
            'tipo_usuario' => 2,
            'password' => "123456789",
        ];

        $nutricionistaInfo = [
            'crn' => "111111111111111111111111111111111111111111111",
            'uf' => "AC",
        ];

        $this->browse(function (Browser $browser) use ($usuarioInfo, $nutricionistaInfo) {
            $browser->visit("/register")
                ->type("nome", $usuarioInfo['nome'])
                ->type("email", $usuarioInfo['email'])
                ->type("cpf", $usuarioInfo['cpf'])
                ->type("telefone1", $usuarioInfo['telefone_1'])
                ->type("telefone2", $usuarioInfo['telefone_2'])
                ->type("crn", $nutricionistaInfo['crn'])
                ->select("uf", $nutricionistaInfo['uf'])
                ->type("password", $usuarioInfo['password'])
                ->type("password_confirmation", $usuarioInfo['password'])
                ->press('Cadastro')
                ->assertPathIs('/email/verify')
                ->logout();
        });
    }
}
