<?php

namespace Tests\Unit;


use App\Services\GeradorCPF;
use App\Models\Nutricionista;
use App\Models\User;
use App\Repository\NutricionistaRepository;
use App\Repository\UserRepository;
use App\Services\AdminService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AprovacaoNutriTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function testCriarNutricionistaPendente()
    {
        $usuario = User::create([
            'nome' =>  $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)97988-5544',
            'telefone_2' => '(82)97988-5544',
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'tipo_usuario' => 2,
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        Nutricionista::create([
            "crn" => Str::random(45),
            "uf" => "PE",
            "user_id" => $usuario->id
        ]);

        $this->assertEquals(0, $usuario->cadastro_aprovado);
    }

    /** @test */
    public function testAtivarNutricionistaPendente()
    {

        $nutricionistaRepository = new NutricionistaRepository();
        $userRepository = new UserRepository();
        $adminService = new AdminService($userRepository, $nutricionistaRepository);

        $nutricionista  = $nutricionistaRepository->all()->last();

        $adminService->ativarCadastro($nutricionista->user->id);
        $usuarioNutricionista = $nutricionista->user->refresh();

        $this->assertEquals(1,  $usuarioNutricionista->cadastro_aprovado);
    }

    /** @test */
    public function testReprovarNutricionistaPendente()
    {

        $usuario = User::create([
            'nome' =>  $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)97988-5544',
            'telefone_2' => '(82)97988-5544',
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'tipo_usuario' => 2,
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        Nutricionista::create([
            "crn" => Str::random(45),
            "uf" => "PE",
            "user_id" => $usuario->id
        ]);

        $nutricionistaRepository = new NutricionistaRepository();
        $userRepository = new UserRepository();
        $adminService = new AdminService($userRepository, $nutricionistaRepository);

        $nutricionista  = $nutricionistaRepository->all()->last();

        $adminService->recusarCadastro($nutricionista->user->id);

        $usuario = User::find($nutricionista->user->id);

        $this->assertEquals(null, $usuario);
    }

    /** @test */
    public function testVerificarNutricionistaDesativaPaciente()
    {
        $paciente = Paciente::factory(1)->create()->first();
        $this->assertNull(User::onlyTrashed()->where('id', $paciente->user->id)->first());

        $userRepository = new UserRepository();
        $pacienteRepository = new PacienteRepository();
        $nutricionistaRepository = new NutricionistaRepository();
        $nutricionistaService = new NutricionistaService($pacienteRepository, $nutricionistaRepository, $userRepository);
        
        $nutricionistaService->inativar_paciente($paciente->id);

        $this->assertNotNull(User::onlyTrashed()->where('id', $paciente->user->id)->first());
    }
}
