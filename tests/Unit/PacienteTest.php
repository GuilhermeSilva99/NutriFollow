<?php

namespace Tests\Unit;

use App\Models\Nutricionista;
use App\Models\Paciente;
use App\Models\User;
use App\Services\GeradorCPF;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertEquals;

class PacienteTest extends TestCase
{
    use WithFaker;

    public function testCriarPaciente()
    {
        $dadosCadastro = [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(), 'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)98877-6655', 'telefone_2' => '(82)98877-6655',
            'sexo-select' => 'masculino', 'sexo-input' => null, 'obs' => null,
            'password' => '12345678',  'password_confirmation' => '12345678',
        ];

        $usuarioBD = User::where('tipo_usuario', 2)->where('cadastro_aprovado', 1)->first();

        $this->actingAs($usuarioBD)->post('/paciente/create', $dadosCadastro);

        $pacienteUsuario = User::where('cpf', $dadosCadastro['cpf'])->first();

        assertEquals($dadosCadastro['cpf'], $pacienteUsuario->cpf);
    }

    public function testEditarPaciente()
    {
        //Criando paciente
        $dados = [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(), 'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)98877-6655', 'telefone_2' => '(82)98877-6655',
            'sexo-select' => 'masculino', 'sexo-input' => null, 'obs' => null,
            'password' => '12345678',  'password_confirmation' => '12345678',
        ];

        $usuarioBD = User::where('tipo_usuario', 2)->where('cadastro_aprovado', 1)->first();
        $this->actingAs($usuarioBD)->post('/paciente/create', $dados);

        //Editar pacente
        $nutricionistaBD = Nutricionista::where('user_id', $usuarioBD->id)->first();
        $pacienteCadastrado = Paciente::where('nutricionista_id', $nutricionistaBD->id)->orderBy('created_at', 'desc')->first();

        $dados['id'] = $pacienteCadastrado->user_id;
        $dados['nome'] = 'Joaquina da Silva';
        $dados['cpf'] = GeradorCPF::gerarCPF(true);
        $dados['email'] = $this->faker->unique()->safeEmail();
        $dados['telefone_1'] = '(81)98877-6655';
        $dados['telefone_2'] = '(81)98877-6600';
        $dados['sexo-select'] = 'feminino';
        $dados['obs'] = 'Teste edition';

        $this->actingAs($usuarioBD)->post('/editar/paciente', $dados);

        $usuarioEditado = User::find($pacienteCadastrado->user_id);
        $pacienteCadastrado = $pacienteCadastrado->refresh();

        assertEquals('Joaquina da Silva', $usuarioEditado->nome);
        assertEquals($dados['cpf'], $usuarioEditado->cpf);
        assertEquals($dados['email'], $usuarioEditado->email);
        assertEquals('(81)98877-6655', $usuarioEditado->telefone_1);
        assertEquals('(81)98877-6600', $usuarioEditado->telefone_2);
        assertEquals('Teste edition', $pacienteCadastrado->observacoes);
        assertEquals('feminino', $pacienteCadastrado->sexo);
    }

    public function testPacienteView()
    {
        $dados = [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(), 'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)98877-6655', 'telefone_2' => '(82)98877-6655',
            'sexo-select' => 'masculino', 'sexo-input' => null, 'obs' => null,
            'password' => '12345678',  'password_confirmation' => '12345678',
        ];

        $usuarioBD = User::where('tipo_usuario', 2)->where('cadastro_aprovado', 1)->first();
        $this->actingAs($usuarioBD)->post('/paciente/create', $dados);

        //listando o paciente
        $nutricionistaBD = Nutricionista::where('user_id', $usuarioBD->id)->first();
        $paciente = Paciente::where('nutricionista_id', '=', $nutricionistaBD->id)->orderBy('created_at', 'desc')->first();

        $response = $this->actingAs($usuarioBD)->get('/view/paciente/' . $paciente->user_id);
        $this->assertEquals(200, $response->status());
    }
}
