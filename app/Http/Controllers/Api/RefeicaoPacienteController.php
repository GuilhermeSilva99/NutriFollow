<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRefeicaoPacienteRequest;
use App\Http\Requests\UpdateRefeicaoPacienteRequest;
use App\Services\RefeicaoPacienteService;

class RefeicaoPacienteController extends Controller
{

    private $refeicaoPacienteService;

    public function __construct(RefeicaoPacienteService $refeicaoPacienteService)
    {
        $this->refeicaoPacienteService = $refeicaoPacienteService;
    }

    public function listarRefeicaoDoPaciente(Request $request)
    {
        return $this->refeicaoPacienteService->listarRefeicaoDoPaciente($request->user()->paciente->id);
    }

    public function criarRefeicaoPaciente(StoreRefeicaoPacienteRequest $request)
    {
        $dados = $request->validated();
        return $this->refeicaoPacienteService->criarRefeicaoPaciente($dados, $request->user()->paciente->id);
    }

    public function recuperarRefeicaoDoPaciente(Request $request)
    {
        return $this->refeicaoPacienteService->recuperarRefeicaoDoPaciente($request->id);
    }

    public function recuperarRefeicaoPaciente(Request $request)
    {
        return $this->refeicaoPacienteService->recuperarRefeicaoPaciente($request->id);
    }

    public function atualizarRefeicaoPaciente(UpdateRefeicaoPacienteRequest $request)
    {
        $dados = $request->validated();
        return $this->refeicaoPacienteService->atualizarRefeicaoPaciente($dados, $request->id);
    }
}
