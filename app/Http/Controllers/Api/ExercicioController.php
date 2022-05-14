<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExercicioRequest;
use App\Http\Requests\UpdateExercicioRequest;
use App\Services\ExercicioService;

class ExercicioController extends Controller
{
    private $exercicioService;

    public function __construct(ExercicioService $exercicioService)
    {
        $this->exercicioService = $exercicioService;
    }

    public function listarExercicios(Request $request)
    {
        return $this->exercicioService->listarExercicios($request->user()->paciente->id);
    }

    public function criarExercicio(StoreExercicioRequest $request)
    {
        $dados = $request->validated();
        return $this->exercicioService->criarExercicio($dados, $request->user()->paciente->id);
    }

    public function deletarExercicio(Request $request)
    {
        return $this->exercicioService->deletarExercicio($request->id);
    }

    public function recuperarExercicio(Request $request)
    {
        return $this->exercicioService->recuperarExercicio($request->id);
    }

    public function atualizarExercicio(StoreExercicioRequest $request)
    {
        $dados = $request->validated();
        return $this->exercicioService->atualizarExercicio($dados, $request->id);
    }
}
