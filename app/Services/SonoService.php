<?php

namespace App\Services;

use App\Repository\{SonoRepository, UserRepository};
use Carbon\Carbon;

class SonoService
{
    private $userRepository;
    private $sonoRepository;

    public function __construct(UserRepository $userRepository, SonoRepository $sonoRepository)
    {
        $this->userRepository = $userRepository;
        $this->sonoRepository = $sonoRepository;
    }

    public function listarSono($pacienteID)
    {
        return $this->sonoRepository->findByColumn("paciente_id", $pacienteID);
    }

    public function listarSonoPorPeriodo($inicio, $fim, $usuarioID)
    {
        Carbon::setlocale('pt-BR');
        if ($inicio == null || $fim == null) {
            $fim = Carbon::now();
            $inicio = Carbon::now()->sub(30, 'days');
        }

        $usuarioPaciente = $this->userRepository->find($usuarioID);
        return $this->sonoRepository->findByPeriod($inicio, $fim, $usuarioPaciente->paciente->id);
    }

    public function criarSono($dadosSono, $pacienteId)
    {
        $data = Carbon::parse($dadosSono["data"]);
        $sono = $this->sonoRepository->findByColumn("data", $data);

        if (count($sono) >= 1)
            return response()->json(["erro" => "Já existe um sono cadastrado nessa data"], 400);

        $dadosSono['paciente_id'] = $pacienteId;
        $this->sonoRepository->save($dadosSono);

        return response()->json(["sucesso" => "Sono cadastrado com sucesso!"], 200);
    }

    public function deletarSono($sonoId)
    {
        $sono = $this->sonoRepository->find($sonoId);
        if ($sono) {
            $this->sonoRepository->softDelete($sono);
            return response()->json(["sucesso" => "Sono deletado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Sono não encontrado"], 400);
    }

    public function recuperarSono($sonoId)
    {
        $sono = $this->sonoRepository->find($sonoId);
        if ($sono)
            return $sono;

        return response()->json(["erro" => "Sono não encontrado"], 400);
    }

    public function atualizarSono($dadosSono, $sonoId)
    {
        $sono = $this->sonoRepository->find($sonoId);
        if ($sono) {
            $this->sonoRepository->updateWithModel($sono, $dadosSono);
            return response()->json(["sucesso" => "Sono atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Sono não encontrado"], 400);
    }
}
