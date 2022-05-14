<?php

namespace App\Services;

use App\Repository\{PacienteRepository, UserRepository};

class PacienteService
{
    private $userRepository;
    private $pacienteRepository;

    public function __construct(UserRepository $userRepository, PacienteRepository $pacienteRepository)
    {
        $this->userRepository = $userRepository;
        $this->pacienteRepository = $pacienteRepository;
    }

    public function minhasInformacoes($pacienteId)
    {
        $paciente = $this->pacienteRepository->find($pacienteId);
        if ($paciente) {
            $dados = $paciente->user;
            $dados["sexo"] = $paciente->sexo;
            $dados["observacoes"] = $paciente->observacoes;
            return $dados;
        }

        return response()->json(["erro" => "Paciente não encontrado"], 400);
    }

    public function atualizarInformacoes($dadosPaciente, $pacienteId)
    {
        $paciente = $this->pacienteRepository->find($pacienteId);
        if ($paciente) {

            $dadosPaciente["sexo"] = $dadosPaciente["sexo-select"] ?? $dadosPaciente["sexo-input"];
            $dadosPaciente["paciente_id"] = $pacienteId;

            $this->userRepository->updateWithModel($paciente->user, $dadosPaciente);
            $this->pacienteRepository->updateWithModel($paciente, $dadosPaciente);

            return response()->json(["sucesso" => "Paciente atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Paciente não encontrado"], 400);
    }
}
