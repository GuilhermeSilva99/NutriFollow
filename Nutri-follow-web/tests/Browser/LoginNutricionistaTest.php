<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginNutricionistaTestLoginNutricionistaTest extends DuskTestCase
{
    public function testLoginNutricioistaCadastroAprovado()
    {
        $usuarioInfo = [
            'nome' => "Usuario teste",
            'email' => "usuario2@email.com",
            'cpf' => "21111111111",
            'telefone_1' => "00000000000",
            'telefone_2' => "00000000000",
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
