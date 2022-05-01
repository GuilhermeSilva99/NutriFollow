<?php

namespace App\Services;

use App\Repository\{ConsumoAguaRepository, SonoRepository, UserRepository};

class PacienteService
{
    private $sonoRepository;
    private $userRepository;
    private $consumoAguaRepository;

    public function __construct(SonoRepository $sonoRepository, UserRepository $userRepository, ConsumoAguaRepository $consumoAguaRepository)
    {
        $this->sonoRepository = $sonoRepository;
        $this->userRepository = $userRepository;
        $this->consumoAguaRepository = $consumoAguaRepository;
    }

    //Sono

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

    // Consumo de água

    public function listarConsumoAgua($usuarioID)
    {
        $usuarioPaciente = $this->userRepository->find($usuarioID);
        return $this->consumoAguaRepository->findByColumn("paciente_id", $usuarioPaciente->paciente->id);
    }

    public function criarConsumoAgua($dadosConsumo, $usuarioID)
    {
        $usuarioPaciente = $this->userRepository->find($usuarioID);
        $dadosConsumo['paciente_id'] = $usuarioPaciente->paciente->id;
        $this->consumoAguaRepository->save($dadosConsumo);
        return response()->json(["sucesso" => "Consumo de água cadastrado com sucesso!"], 200);
    }

    public function deletarConsumoAgua($consumoId)
    {
        $consumo = $this->consumoAguaRepository->find($consumoId);
        if ($consumo) {
            $this->consumoAguaRepository->softDelete($consumo);
            return response()->json(["sucesso" => "Consumo de água deletado com sucesso!"], 200);
        } else {
            return response()->json(["erro" => "Consumo de água não encontrado"], 400);
        }
    }

    public function recuperarConsumoAgua($consumoId)
    {
        $consumo = $this->consumoAguaRepository->find($consumoId);
        if ($consumo)
            return $consumo;
        else
            return response()->json(["erro" => "Consumo de água não encontrado"], 400);
    }

    public function atualizarConsumoAgua($dadosConsumo, $consumoId)
    {
        $consumo = $this->consumoAguaRepository->find($consumoId);
        if ($consumo) {
            $this->consumoAguaRepository->update($consumoId, $dadosConsumo);
            return response()->json(["sucesso" => "Consumo de água atualizado com sucesso!"], 200);
        } else {
            return response()->json(["erro" => "Consumo de água não encontrado"], 400);
        }
    }
}
