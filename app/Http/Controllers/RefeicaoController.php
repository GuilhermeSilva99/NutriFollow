<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use Illuminate\Support\Facades\DB;
use App\Services\RefeicaoPacienteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefeicaoController extends Controller
{
    private $refeicaoPacienteService;

    public function __construct(RefeicaoPacienteService $refeicaoPacienteService)
    {
        $this->refeicaoPacienteService = $refeicaoPacienteService;
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
        $dados = Auth::user()->nutricionista->id;
        Refeicao::create($dados);
        return redirect()->route('dieta.view-dieta', $id);
    }

    public function listarRefeicoes($usuario_id)
    {
        return view('paciente.relatorio-dieta', ['id' => $usuario_id]);
    }
}
