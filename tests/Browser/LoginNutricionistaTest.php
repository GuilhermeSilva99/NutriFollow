<?php

namespace Tests\Browser;

use App\Services\GeradorCPF;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginNutricionistaTestLoginNutricionistaTest extends DuskTestCase
{
    use WithFaker;

    public function testLoginNutricionistaCadastroAprovado()
    {
        $usuarioInfo = [
            'nome' => "Usuario teste",
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => "(00)00000-0000",
            'telefone_2' => "(00)00000-0000",
            'tipo_usuario' => 2,
            'password' => Hash::make("123456789"),
            'tipo_usuario' => 2
        ];

        $usuarioTest = User::create($usuarioInfo);
        $usuarioTest->cadastro_aprovado = 1;
        $usuarioTest->email_verified_at = now();
        $usuarioTest->save();

        $this->browse(function (Browser $browser) use ($usuarioTest) {
            $browser->visit("/login")
                ->type("email", $usuarioTest->email)
                ->type("password", "123456789")
                ->press("LOG IN")
                ->assertPathIs("/dashboard");
        });
    }
}
