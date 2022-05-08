<?php

namespace App\Services;

use App\Repository\ConsumoAguaRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;

class ConsumoAguaService
{
    public function __construct(UserRepository $userRepository, ConsumoAguaRepository $consumoAguaRepository)
    {
        $this->userRepository = $userRepository;
        $this->consumoAguaRepository = $consumoAguaRepository;
    }

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

    public function listarConsumoAguaPorPeriodo($inicio, $fim, $usuarioID)
    {
        Carbon::setlocale('pt-BR');
        if($inicio == null || $fim == null)
        {
            $fim = Carbon::now();
            $inicio = Carbon::now()->sub(30, 'days');
        }        

        $usuarioPaciente = $this->userRepository->find($usuarioID);
        return $this->consumoAguaRepository->findByPeriod($inicio, $fim, $usuarioPaciente->paciente->id);
    }
}
