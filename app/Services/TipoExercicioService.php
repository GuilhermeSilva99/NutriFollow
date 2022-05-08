<?php

namespace App\Services;

use App\Repository\{TipoExercicioRepository, UserRepository};

class TipoExercicioService
{
    private $tipoExercicioRepository;

    public function __construct(TipoExercicioRepository $tipoExercicioRepository)
    {
        $this->tipoExercicioRepository = $tipoExercicioRepository;
    }

    public function listarTipoExercicios($usuarioID)
    {
        return $this->tipoExercicioRepository->all();
    }

    public function recuperarTipoExercicio($consumoId)
    {
        $consumo = $this->tipoExercicioRepository->find($consumoId);
        if ($consumo)
            return $consumo;
        else
            return response()->json(["erro" => "Tipo de exercício não encontrado"], 400);
    }
}
