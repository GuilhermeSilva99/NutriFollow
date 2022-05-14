<?php

namespace Tests\Unit;


use App\Services\GeradorCPF;
use App\Models\Nutricionista;
use App\Models\User;
use App\Models\Paciente;
use App\Repository\ComorbidadeRepository;
use App\Repository\NutricionistaRepository;
use App\Repository\UserRepository;
use App\Repository\PacienteRepository;
use App\Services\AdminService;
use App\Services\NutricionistaService;
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

        $adminService->ativarCadastroNutricionista($nutricionista->user->id);
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

        $adminService->recusarCadastroNutricionista($nutricionista->user->id);

        $usuario = User::find($nutricionista->user->id);

        $this->assertEquals(null, $usuario);
    }

    /** @test */
    public function testVerificarNutricionistaDesativaPaciente()
    {
        $user = User::create([
            'nome' => "paciente",
            'email' => $this->faker->safeEmail(),
            'email_verified_at' => now(),
            'telefone_1' => '(00) 00000-0000',
            'telefone_2' => '(00) 00000-0000',
            'cpf' => GeradorCPF::gerarCPF(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'cadastro_aprovado' => 1,
            'tipo_usuario' => 3,
        ]);

        $nutri = Nutricionista::first();

        $paciente = Paciente::create([
            'sexo' => 'masculino',
            'observacoes' => null,
            'user_id' => $user->id,
            'nutricionista_id' => $nutri->id,
        ]);

        $this->assertNull(User::onlyTrashed()->where('id', $paciente->user->id)->first());

        $userRepository = new UserRepository();
        $pacienteRepository = new PacienteRepository();
        $nutricionistaRepository = new NutricionistaRepository();
        $comorbidadeRepository = new ComorbidadeRepository();
        $nutricionistaService = new NutricionistaService($pacienteRepository, $nutricionistaRepository, $userRepository, $comorbidadeRepository);

        $nutricionistaService->inativarPaciente($paciente->id);

        $this->assertNotNull(User::onlyTrashed()->where('id', $paciente->user->id)->first());
    }
}
