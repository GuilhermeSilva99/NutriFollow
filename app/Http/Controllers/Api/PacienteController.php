<?php

namespace App\Http\Controllers\Api;


use App\Services\PacienteService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSonoRequest;

class PacienteController extends Controller
{

    private $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function index()
    {
        return view('paciente.create-paciente');
    }

    public function listarSono(Request $request)
    {
        return $this->pacienteService->listarSono($request->user()->id);
    }

    public function criarSono(StoreSonoRequest $request)
    {
        $dados = $request->validated();
        return $this->pacienteService->criarSono($dados, $request->user()->id);
    }

    public function deletarSono(Request $request)
    {
        return $this->pacienteService->deletarSono($request->id);
    }

    public function recuperarSono(Request $request)
    {
        return $this->pacienteService->recuperarSono($request->id);
    }

    public function atualizarSono(StoreSonoRequest $request)
    {
        $dados = $request->validated();
        return $this->pacienteService->atualizarSono($dados, $request->id);
    }
}
