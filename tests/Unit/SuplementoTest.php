<?php

namespace Tests\Unit;

use App\Http\Controllers\SuplementoController;
use App\Models\Exame;
use App\Models\Paciente;
use App\Models\Suplemento;
use App\Models\User;
use App\Repository\ComorbidadeRepository;
use App\Repository\ExameRepository;
use App\Repository\NutricionistaRepository;
use App\Repository\PacienteRepository;
use App\Repository\UserRepository;
use App\Services\GeradorCPF;
use App\Services\NutricionistaService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class SuplementoTest extends TestCase
{
    use WithFaker;

    public function testCadastrarSuplementoPaciente()
    {
        $paciente = Paciente::first();
        $suplemento = new Suplemento();
        $suplementoController = new SuplementoController();

        $dados = [
            'nome' => 'BCAA',  'data_inicio' => '2022-05-02', 'quantidade' => '2 scup',
            'data_fim' => '2022-07-02', 'paciente_id' => $paciente->id
        ];
        $request = new Request($dados);
        $suplementoController->store($request);
        $ultimoSuplemento = $suplemento->latest()->first();
        assertEquals($dados['nome'], $ultimoSuplemento->nome);
        assertEquals($dados['quantidade'], $ultimoSuplemento->quantidade);
        assertEquals($dados['data_inicio'], $ultimoSuplemento->data_inicio);
        assertEquals($dados['data_fim'], $ultimoSuplemento->data_fim);
        assertEquals($dados['paciente_id'], $ultimoSuplemento->paciente_id);
    }

    public function testEditarSuplementoPaciente()
    {
        $paciente = Paciente::first();
        $suplemento = new Suplemento();
        $suplementoController = new SuplementoController();

        $dados = [
            'nome' => 'whey',  'data_inicio' => '2022-05-02', 'quantidade' => '4 scup',
            'data_fim' => '2022-07-02', 'paciente_id' => $paciente->id
        ];
        $request = new Request($dados);

        $dados2 = [
            'nome' => 'whey',  'data_inicio' => '2022-05-02', 'quantidade' => '4 scup',
            'data_fim' => '2022-07-02', 'paciente_id' => $paciente->id
        ];
        $request2 = new Request($dados2);
        $suplementoController->store($request);
        $ultimoSuplemento = $suplemento->latest()->first();
        $suplementoController->atualizarSuplemento($request2, $ultimoSuplemento->id);
        $ultimoSuplemento = $suplemento->latest()->first();
        assertEquals($dados['nome'], $ultimoSuplemento->nome);
        assertEquals($dados['quantidade'], $ultimoSuplemento->quantidade);
        assertEquals($dados['data_inicio'], $ultimoSuplemento->data_inicio);
        assertEquals($dados['data_fim'], $ultimoSuplemento->data_fim);
        assertEquals($dados['paciente_id'], $ultimoSuplemento->paciente_id);
    }

    public function testDeletarSuplementoPaciente()
    {
        $paciente = Paciente::first();
        $suplemento = new Suplemento();
        $suplementoController = new SuplementoController();

        $dados = [
            'nome' => 'creatira',  'data_inicio' => '2022-05-02', 'quantidade' => '90 scup',
            'data_fim' => '2022-07-02', 'paciente_id' => $paciente->id
        ];
        $request = new Request($dados);
        $suplementoController->store($request);
        $ultimoSuplemento = $suplemento->latest()->first();
        
        $delete = Suplemento::destroy($ultimoSuplemento->id);
        assertEquals(1, $delete);
    }
}
