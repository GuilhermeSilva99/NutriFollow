<?php

namespace App\Services;

use App\Repository\{ExercicioRepository};
use Carbon\Carbon;

class ExercicioService
{
    private $exercicioRepository;

    public function __construct(ExercicioRepository $exercicioRepository)
    {
        $this->exercicioRepository = $exercicioRepository;
    }

    public function listarExercicios($pacienteId)
    {
        return $this->exercicioRepository->findByColumn("paciente_id", $pacienteId);
    }

    public function criarExercicio($dadosExercicio, $pacienteId)
    {
        $data = Carbon::parse($dadosExercicio["data"]);
        $sono = $this->exercicioRepository->findByColumn("data", $data);

        if (count($sono) >= 1)
            return response()->json(["erro" => "Já existe um exercício cadastrado nessa data"], 400);

        $dadosExercicio['paciente_id'] = $pacienteId;
        $this->exercicioRepository->save($dadosExercicio);

        return response()->json(["sucesso" => "Exercício cadastrado com sucesso!"], 200);
    }

    public function deletarExercicio($exercicioId)
    {
        $exercicio = $this->exercicioRepository->find($exercicioId);
        if ($exercicio) {
            $this->exercicioRepository->softDelete($exercicio);
            return response()->json(["sucesso" => "Exercício deletado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Exercício não encontrado"], 400);
    }

    public function recuperarExercicio($exercicioId)
    {
        $exercicio = $this->exercicioRepository->find($exercicioId);
        if ($exercicio)
            return $exercicio;

        return response()->json(["erro" => "Exercício não encontrado"], 400);
    }

    public function atualizarExercicio($dadosExercicio, $exercicioId)
    {
        $exercicio = $this->exercicioRepository->find($exercicioId);
        if ($exercicio) {
            $this->exercicioRepository->updateWithModel($exercicio, $dadosExercicio);
            return response()->json(["sucesso" => "Exercício atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Exercício não encontrado"], 400);
    }
}
