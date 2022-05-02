<?php

namespace Tests\Browser;

use App\Services\GeradorCPF;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CadastroNutricionistaTest extends DuskTestCase
{
    use WithFaker;

    public function testCadastrarNutricionista()
    {
        $usuarioInfo = [
            'nome' => "Usuario teste",
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => "(00)00000-0000",
            'telefone_2' => "(00)00000-0000",
            'tipo_usuario' => 2,
            'password' => "123456789",
        ];

        $nutricionistaInfo = [
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => "AC",
        ];

        $this->browse(function (Browser $browser) use ($usuarioInfo, $nutricionistaInfo) {
            $browser->visit("/register")
                ->type("nome", $usuarioInfo['nome'])
                ->type("email", $usuarioInfo['email'])
                ->type("cpf", $usuarioInfo['cpf'])
                ->type("telefone_1", $usuarioInfo['telefone_1'])
                ->type("telefone_2", $usuarioInfo['telefone_2'])
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
