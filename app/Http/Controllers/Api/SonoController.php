<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSonoRequest;
use App\Http\Requests\UpdateSonoRequest;
use App\Services\SonoService;

class SonoController extends Controller
{

    private $sonoService;

    public function __construct(SonoService $sonoService)
    {
        $this->sonoService = $sonoService;
    }

    public function listarSono(Request $request)
    {
        return $this->sonoService->listarSono($request->user()->id);
    }

    public function criarSono(StoreSonoRequest $request)
    {
        $dados = $request->validated();
        return $this->sonoService->criarSono($dados, $request->user()->id);
    }

    public function deletarSono(Request $request)
    {
        return $this->sonoService->deletarSono($request->id);
    }

    public function recuperarSono(Request $request)
    {
        return $this->sonoService->recuperarSono($request->id);
    }

    public function atualizarSono(UpdateSonoRequest $request)
    {
        $dados = $request->validated();
        return $this->sonoService->atualizarSono($dados, $request->id);
    }
}
