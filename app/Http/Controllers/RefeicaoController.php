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

    public function listarRefeicoes($usuario_id, Request $request)
    {
        $paciente = $this->pacienteService->findByUserID($usuario_id);
        $refeicoes = $this->refeicaoPacienteService->listarRefeicaoDoPacienteByUserId($usuario_id);
        $dias = [];

        foreach ($refeicoes as $refeicao)
        {
            $dia = date('d-m-y', strtotime($refeicao->data));
            $refeicao->data = $dia;

            if(array_key_exists($dia, $dias))
            {
                array_push($dias[$dia], $refeicao);
            }
            else
            {
                $dias[$dia] = [$refeicao];
            }
        }

        return view('paciente.relatorio-dieta', ['id' => $usuario_id, 'paciente' => $paciente, 'refeicoes' => $dias]);
    }
}
