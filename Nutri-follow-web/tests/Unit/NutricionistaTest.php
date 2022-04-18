<?php

namespace Tests\Unit;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Admin\HomeController;
use App\Services\GeradorCPF;
use App\Models\Nutricionista;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AprovacaoNutriTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function create_nutricionista_pendente()
    {
        $user = new CreateNewUser();

        $usuario = $user->create([
            'nome' =>  $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone1' => '(82)97988-5544',
            'telefone2' => '(82)97988-5544',
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertEquals(0, $usuario->cadastro_aprovado);
    }

    /** @test */
    public function ativar_nutricionista_pendente()
    {

        $usuario = User::create([
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(87)98899-7744',
            'telefone_2' => '(87)98899-7744',
            'tipo_usuario' => 2,
            'password' => '12345678',
        ]);

        Nutricionista::create([
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'user_id' => $usuario->id,
        ]);

        $admin = new HomeController();
        $admin->ativar_cadastro($usuario->id);

        $usuario = User::find($usuario->id);

        $this->assertEquals(1,  $usuario->cadastro_aprovado);
    }

    /** @test */
    public function reprovar_nutricionista_pendente()
    {

        $usuario = User::create([
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(87)98899-7744',
            'telefone_2' => '87988997744',
            'tipo_usuario' => 2,
            'password' => '12345678',
        ]);

        Nutricionista::create([
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'user_id' => $usuario->id,
        ]);

        $admin = new HomeController();
        $admin->recusar_cadastro($usuario->id);

        $usuario = User::find($usuario->id);

        $this->assertEquals(null,  $usuario);
    }
}
