<?php

namespace App\Services;

use App\Repository\{SonoRepository, UserRepository};

class PacienteService
{
    private $sonoRepository;
    private $userRepository;

    public function __construct(SonoRepository $sonoRepository, UserRepository $userRepository)
    {
        $this->sonoRepository = $sonoRepository;
        $this->userRepository = $userRepository;
    }

    public function listarSono($usuarioID)
    {
        $usuarioPaciente = $this->userRepository->find($usuarioID);
        return $this->sonoRepository->findByColumn("paciente_id", $usuarioPaciente->paciente->id);
    }

    public function criarSono($dadosSono, $usuarioID)
    {
        $usuarioPaciente = $this->userRepository->find($usuarioID);
        $dadosSono['paciente_id'] = $usuarioPaciente->paciente->id;
        $this->sonoRepository->save($dadosSono);
        return response()->json(["sucesso" => "Sono cadastrado com sucesso!"], 200);
    }

    public function deletarSono($sonoId)
    {
        $sono = $this->sonoRepository->find($sonoId);
        if ($sono) {
            $this->sonoRepository->softDelete($sono);
            return response()->json(["sucesso" => "Sono deletado com sucesso!"], 200);
        } else {
            return response()->json(["erro" => "Sono não encontrado"], 400);
        }
    }

    public function recuperarSono($sonoId)
    {
        $sono = $this->sonoRepository->find($sonoId);
        if ($sono)
            return $sono;
        else
            return response()->json(["erro" => "Sono não encontrado"], 400);
    }

    public function atualizarSono($dadosSono, $sonoId)
    {
        $sono = $this->sonoRepository->find($sonoId);
        if ($sono) {
            $this->sonoRepository->update($sonoId, $dadosSono);
            return response()->json(["sucesso" => "Sono atualizado com sucesso!"], 200);
        } else {
            return response()->json(["erro" => "Sono não encontrado"], 400);
        }
    }
}
