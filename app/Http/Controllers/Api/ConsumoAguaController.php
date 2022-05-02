<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsumoAguaRequest;
use App\Services\ConsumoAguaService;

class ConsumoAguaController extends Controller
{

    private $consumoAguaService;

    public function __construct(ConsumoAguaService $consumoAguaService)
    {
        $this->consumoAguaService = $consumoAguaService;
    }

    public function listarConsumoAgua(Request $request)
    {
        return $this->consumoAguaService->listarConsumoAgua($request->user()->id);
    }

    public function criarConsumoAgua(StoreConsumoAguaRequest $request)
    {
        $dados = $request->validated();
        return $this->consumoAguaService->criarConsumoAgua($dados, $request->user()->id);
    }

    public function deletarConsumoAgua(Request $request)
    {
        return $this->consumoAguaService->deletarConsumoAgua($request->id);
    }

    public function recuperarConsumoAgua(Request $request)
    {
        return $this->consumoAguaService->recuperarConsumoAgua($request->id);
    }

    public function atualizarConsumoAgua(StoreConsumoAguaRequest $request)
    {
        $dados = $request->validated();
        return $this->consumoAguaService->atualizarConsumoAgua($dados, $request->id);
    }
}
