<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repository\NutricionistaRepository;
use App\Repository\PacienteRepository;
use App\Repository\UserRepository;
use App\Services\GeradorCPF;
use App\Services\NutricionistaService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertEquals;

class PacienteTest extends TestCase
{
    use WithFaker;

    public function testCriarPaciente()
    {
        $nutricionistaRepository = new NutricionistaRepository();
        $userRepository = new UserRepository();
        $pacienteRepository = new PacienteRepository();

        $dadosCadastro = [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(), 'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)98877-6655', 'telefone_2' => '(82)98877-6655',
            'sexo-select' => 'masculino', 'sexo-input' => null, 'obs' => "observações",
            'password' => '12345678',  'password_confirmation' => '12345678', "tipo_usuario" => 3
        ];

        $usuarioPaciente = $userRepository->save($dadosCadastro);
        $nutricionistaPaciente = $nutricionistaRepository->findByColumn("user_id", 2)->first();

        $dadosCadastro['sexo'] = $dadosCadastro['sexo-select'] ?? $dadosCadastro['sexo-input'];
        $dadosCadastro['user_id'] = $usuarioPaciente->id;
        $dadosCadastro['nutricionista_id'] = $nutricionistaPaciente->id;

        $pacienteRepository->save($dadosCadastro);

        $pacienteUsuario = User::where('cpf', $dadosCadastro['cpf'])->first();

        assertEquals($dadosCadastro['cpf'], $pacienteUsuario->cpf);
    }

    public function testEditarPaciente()
    {
        $nutricionistaRepository = new NutricionistaRepository();
        $userRepository = new UserRepository();
        $pacienteRepository = new PacienteRepository();
        $nutriService = new NutricionistaService($pacienteRepository, $nutricionistaRepository, $userRepository);

        $dados = [
            'nome' => "Joaquina da Silva",
            'email' => $this->faker->unique()->safeEmail(), 'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(81)98877-6655', 'telefone_2' => '(81)98877-6600',
            'sexo-select' => 'feminino', 'sexo-input' => null, 'obs' => 'Teste edition',
            'password' => '12345678',  'password_confirmation' => '12345678',
        ];

        $nutriService->editar($dados, 3);

        $usuarioPaciente = $pacienteRepository->find(1);

        assertEquals('Joaquina da Silva', $usuarioPaciente->user->nome);
        assertEquals($dados['cpf'], $usuarioPaciente->user->cpf);
        assertEquals($dados['email'], $usuarioPaciente->user->email);
        assertEquals('(81)98877-6655', $usuarioPaciente->user->telefone_1);
        assertEquals('(81)98877-6600', $usuarioPaciente->user->telefone_2);
        assertEquals('Teste edition', $usuarioPaciente->observacoes);
        assertEquals('feminino', $usuarioPaciente->sexo);
    }
}
