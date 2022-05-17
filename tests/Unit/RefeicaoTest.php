<?php

namespace Tests\Unit;

use App\Models\Exame;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Nutricionista;
use App\Models\Dieta;
use App\Http\Controllers\DietaController;
use App\Models\Refeicao;
use App\Http\Controllers\RefeicaoController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\{RefeicaoPacienteService, PacienteService};
use App\Repository\{DietaRepository, RefeicaoNutricionistaRepository, RefeicaoPacienteRepository, RefeicaoRepository, PacienteRepository};
use App\Repository\{ UserRepository};
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class RefeicaoTest extends TestCase
{
    use WithFaker;



    public function testCadastrarDietaPaciente(){
        $dieta = new Dieta();
        $ultimaDieta = $dieta->latest()->first();

        $refeicao = new Refeicao();

        $refeicaoRepostiory = new RefeicaoRepository();
        $refeicaoPacienteRepostiory = new RefeicaoPacienteRepository();
        $refeicaoNutricionistaRepostiory = new RefeicaoNutricionistaRepository();
        $dietaRepository = new DietaRepository();
        $pacienteRepository = new PacienteRepository();

        $refeicaoPacienteService = new RefeicaoPacienteService($refeicaoRepostiory, $refeicaoPacienteRepostiory, $refeicaoNutricionistaRepostiory,  $dietaRepository,  $pacienteRepository);
        $userRepository = new UserRepository();
        $pacienteService = new PacienteService($userRepository, $pacienteRepository);
        $refeicaoController = new RefeicaoController($refeicaoPacienteService, $pacienteService);
        
        $dados = [
            'nome_refeicao' => 'nome da refeicao',  'descricao_refeicao' => 'descricao da refeicao',
            'caloria' =>'1000', 'horario'=>'04:45:00', 'dieta_id' => $ultimaDieta->id,
        ];
        
        $request = new Request($dados);
        

        $nutricionista = User::where('tipo_usuario', 2)->first();
        $this->actingAs($nutricionista);

        $refeicaoController->store($request);
        $ultimaRefeicao = $refeicao->latest()->first();


        assertEquals($dados['nome_refeicao'], $ultimaRefeicao->nome_refeicao);
        assertEquals($dados['descricao_refeicao'], $ultimaRefeicao->descricao_refeicao);
        assertEquals($dados['caloria'], $ultimaRefeicao->caloria);
        assertEquals($dados['horario'], $ultimaRefeicao->horario);
        assertEquals($dados['dieta_id'], $ultimaRefeicao->dieta_id);
    }

    
    public function testEditarDietaPaciente(){
        $dieta = new Dieta();
        $ultimaDieta = $dieta->latest()->first();

        $refeicao = new Refeicao();

        $refeicaoRepostiory = new RefeicaoRepository();
        $refeicaoPacienteRepostiory = new RefeicaoPacienteRepository();
        $refeicaoNutricionistaRepostiory = new RefeicaoNutricionistaRepository();
        $dietaRepository = new DietaRepository();
        $pacienteRepository = new PacienteRepository();

        $refeicaoPacienteService = new RefeicaoPacienteService($refeicaoRepostiory, $refeicaoPacienteRepostiory, $refeicaoNutricionistaRepostiory,  $dietaRepository,  $pacienteRepository);
        $userRepository = new UserRepository();
        $pacienteService = new PacienteService($userRepository, $pacienteRepository);
        $refeicaoController = new RefeicaoController($refeicaoPacienteService, $pacienteService);
        
        $dados = [
            'nome_refeicao' => 'nome da refeicao',  'descricao_refeicao' => 'descricao da refeicao',
            'caloria' =>'1000', 'horario'=>'04:45:00', 'dieta_id' => $ultimaDieta->id,
        ];
        
        $request = new Request($dados);
        

        $nutricionista = User::where('tipo_usuario', 2)->first();
        $this->actingAs($nutricionista);

        $refeicaoController->store($request);
        $ultimaRefeicao = $refeicao->latest()->first();



        #----------------------------------------------------------------------

        $dados_edit = [
            'nome_refeicao' => 'nome da refeica editada',  'descricao_refeicao' => 'descricao da refeicao editada',
            'caloria' =>'2000', 'horario'=>'08:45:00'
        ];
        
        $request = new Request($dados_edit);

        $refeicaoController->atualizarRefeicao($request, $ultimaRefeicao->id);

        $refeicaoEditada = $refeicao->find($ultimaRefeicao->id);
        
        assertEquals($dados_edit['nome_refeicao'], $refeicaoEditada->nome_refeicao);
        assertEquals($dados_edit['descricao_refeicao'], $refeicaoEditada->descricao_refeicao);
        assertEquals($dados_edit['caloria'], $refeicaoEditada->caloria);
        assertEquals($dados_edit['horario'], $refeicaoEditada->horario);

    }
    
    
}
