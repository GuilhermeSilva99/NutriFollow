<?php

namespace App\Services;

use App\Repository\{ExercicioRepository, UserRepository};
use Carbon\Carbon;

class ExercicioService
{
    private $exercicioRepository;
    private $userRepository;

    public function __construct(ExercicioRepository $exercicioRepository, UserRepository $userRepository)
    {
        $this->exercicioRepository = $exercicioRepository;
        $this->userRepository = $userRepository;
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

        if (
            !array_key_exists("tipo_exercicio_id", $dadosExercicio) ||
            $dadosExercicio["tipo_exercicio_id"] == null
        )
            $dadosExercicio["tipo_exercicio_id"] = 1;

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
            $data = Carbon::parse($dadosExercicio["data"] ?? $exercicio->data);
            $listaExercicio = $this->exercicioRepository->findByColumnExceptConsumo("data", $data, $exercicio->id);

            if (count($listaExercicio) >= 1)
                return response()->json(["erro" => "Já existe um exercício cadastrado nessa data"], 400);

            $this->exercicioRepository->updateWithModel($exercicio, $dadosExercicio);
            return response()->json(["sucesso" => "Exercício atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Exercício não encontrado"], 400);
    }

    public function listarExercicioPorPeriodo($inicio, $fim, $usuarioID)
    {
        Carbon::setlocale('pt-BR');
        if ($inicio == null || $fim == null) {
            $fim = Carbon::now();
            $inicio = Carbon::now()->sub(30, 'days');
        }

        $usuarioPaciente = $this->userRepository->find($usuarioID);
        return $this->exercicioRepository->findByPeriod($inicio, $fim, $usuarioPaciente->paciente->id);
    }
}
