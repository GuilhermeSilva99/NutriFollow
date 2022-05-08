<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TipoExercicioService;

class TipoExercicioController extends Controller
{
    private $tipoExercicioService;

    public function __construct(TipoExercicioService $tipoExercicioService)
    {
        $this->tipoExercicioService = $tipoExercicioService;
    }

    public function listarTipoExercicios(Request $request)
    {
        return $this->tipoExercicioService->listarTipoExercicios($request->user()->id);
    }

    public function recuperarTipoExercicio(Request $request)
    {
        return $this->tipoExercicioService->recuperarTipoExercicio($request->id);
    }
}
