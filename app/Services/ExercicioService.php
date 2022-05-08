<?php

namespace App\Services;

use App\Repository\{ExercicioRepository, UserRepository};
use Carbon\Carbon;

class ExercicioService
{
    private $exercicioRepository;
    private $userRepository;

    public function __construct(UserRepository $userRepository, ExercicioRepository $exercicioRepository)
    {
        $this->userRepository = $userRepository;
        $this->exercicioRepository = $exercicioRepository;
    }

    public function listarExercicios($usuarioID)
    {
        $usuarioPaciente = $this->userRepository->find($usuarioID);
        return $this->exercicioRepository->findByColumn("paciente_id", $usuarioPaciente->paciente->id);
    }

    public function criarExercicio($dadosExercicio, $usuarioID)
    {
        $data = Carbon::parse($dadosExercicio["data"]);
        $sono = $this->exercicioRepository->findByColumn("data", $data);

        if (count($sono) >= 1)
            return response()->json(["erro" => "Já existe um exercício cadastrado nessa data"], 400);

        $usuarioPaciente = $this->userRepository->find($usuarioID);
        $dadosExercicio['paciente_id'] = $usuarioPaciente->paciente->id;
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
            $this->exercicioRepository->update($exercicioId, $dadosExercicio);
            return response()->json(["sucesso" => "Exercício atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Exercício não encontrado"], 400);
    }
}
