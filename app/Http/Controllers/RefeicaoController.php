<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use App\Models\RefeicaoNutricionista;
use Illuminate\Support\Facades\DB;
use App\Services\{RefeicaoPacienteService, PacienteService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefeicaoController extends Controller
{
    private $refeicaoPacienteService;
    private $pacienteService;

    public function __construct(RefeicaoPacienteService $refeicaoPacienteService, PacienteService $pacienteService)
    {
        $this->refeicaoPacienteService = $refeicaoPacienteService;
        $this->pacienteService = $pacienteService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_refeicao' => 'required',
            'descricao_refeicao' => 'required',
            'caloria' => 'required',
            'horario' => 'required',
        ]);

        $dados = $request->all();
        $id = $dados['dieta_id'];
        $refeicao = Refeicao::create($dados);
        RefeicaoNutricionista::create([
            "nutricionista_id" => Auth::user()->nutricionista->id,
            "refeicao_id" => $refeicao->id
        ]);
        return redirect()->route('dieta.view-dieta', $id);
    }
    
    public function editarRefeicao($id){
        try {
            $refeicao = Refeicao::find($id);
            return view('refeicao.edit-refeicao',['refeicao' => $refeicao]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function atualizarRefeicao(Request $request, $id){
        try {
            $validated = $request->validate([
                'nome_refeicao' => 'required',
                'descricao_refeicao' => 'required',
                'caloria' => 'required',
                'horario' => 'required',
            ]);
            $dados = $request->all();
            $refeicao = Refeicao::find($id);
            $refeicao->nome_refeicao = $dados['nome_refeicao'];
            $refeicao->descricao_refeicao = $dados['descricao_refeicao'];
            $refeicao->caloria = $dados['caloria'];
            $refeicao->horario = $dados['horario'];
    
            $refeicao->save();
            return redirect()->back();

        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }
    
    public function listarRefeicoes($usuario_id, Request $request)
    {
        $paciente = $this->pacienteService->findByUserID($usuario_id);
        $refeicoes = $this->refeicaoPacienteService->listarRefeicaoPorPeriodo($request->inicio, $request->fim, $usuario_id);

        $refeicoes_por_dia = [];
        $caloria_por_dia = [];
            
        foreach ($refeicoes as $refeicao)
        {
            $dia = date('d-m-y', strtotime($refeicao->data));
            $refeicao->data = $dia;

            if(array_key_exists($dia, $refeicoes_por_dia))
            {
                array_push($refeicoes_por_dia[$dia], $refeicao);
                $caloria_por_dia[$dia] += $refeicao->caloria;
            }
            else
            {
                $refeicoes_por_dia[$dia] = [$refeicao];
                $caloria_por_dia[$dia] = $refeicao->caloria;
            }
        }

        return view('paciente.relatorio-dieta', [   'id' => $usuario_id, 
                                                    'paciente' => $paciente,
                                                    'refeicoes' => $refeicoes_por_dia,
                                                    'inicio'=>array_key_first($refeicoes_por_dia),
                                                    'datas' => json_encode(array_keys($refeicoes_por_dia)),
                                                    'calorias' => json_encode(array_values($caloria_por_dia))]);
    }
}
