<?php

namespace App\Http\Controllers\Api;


use App\Services\PacienteService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsumoAguaRequest;
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

    //Sono

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

    //Consumo de água

    public function listarConsumoAgua(Request $request)
    {
        return $this->pacienteService->listarConsumoAgua($request->user()->id);
    }

    public function criarConsumoAgua(StoreConsumoAguaRequest $request)
    {
        $dados = $request->validated();
        return $this->pacienteService->criarConsumoAgua($dados, $request->user()->id);
    }

    public function deletarConsumoAgua(Request $request)
    {
        return $this->pacienteService->deletarConsumoAgua($request->id);
    }

    public function recuperarConsumoAgua(Request $request)
    {
        return $this->pacienteService->recuperarConsumoAgua($request->id);
    }

    public function atualizarConsumoAgua(StoreConsumoAguaRequest $request)
    {
        $dados = $request->validated();
        return $this->pacienteService->atualizarConsumoAgua($dados, $request->id);
    }
}
