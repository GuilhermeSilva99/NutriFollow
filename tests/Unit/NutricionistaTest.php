<?php

namespace Tests\Unit;

use App\Actions\Fortify\CreateNewUser;
use App\Repository\{NutricionistaRepository, UserRepository, PacienteRepository};
use App\Services\{AdminService, NutricionistaService};
use App\Services\GeradorCPF;
use App\Models\{Nutricionista, User, Paciente};
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AprovacaoNutriTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function testCriarNutricionistaPendente()
    {
        $user = new CreateNewUser();

        $usuario = $user->create([
            'nome' =>  $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)97988-5544',
            'telefone_2' => '(82)97988-5544',
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertEquals(0, $usuario->cadastro_aprovado);
    }

    /** @test */
    public function testAtivarNutricionistaPendente()
    {
        $userRepository = new UserRepository();
        $nutricionistaRepository = new NutricionistaRepository();
        $admin_service = new AdminService( $userRepository, $nutricionistaRepository);
        $nutricionista = Nutricionista::factory(1)->create()->first();

        $admin_service->ativarCadastro($nutricionista->user->id);

        $this->assertEquals(1,  $nutricionista->user->cadastro_aprovado);
    }

    /** @test */
    public function testReprovarNutricionistaPendente()
    {
        $userRepository = new UserRepository();
        $nutricionistaRepository = new NutricionistaRepository();
        $admin_service = new AdminService( $userRepository, $nutricionistaRepository);
        $nutricionista = Nutricionista::factory(1)->create()->first();

        $admin_service->recusarCadastro($nutricionista->user->id);

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
