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
        $data = Carbon::parse($dadosConsumo["data"]);
        $consumoAgua = $this->consumoAguaRepository->findByColumn("data", $data);

        if (count($consumoAgua) >= 1)
            return response()->json(["erro" => "Já existe um consumo de água nessa data"], 400);

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
        }

        return response()->json(["erro" => "Consumo de água não encontrado"], 400);
    }

    public function recuperarConsumoAgua($consumoId)
    {
        $consumo = $this->consumoAguaRepository->find($consumoId);
        if ($consumo)
            return $consumo;

        return response()->json(["erro" => "Consumo de água não encontrado"], 400);
    }

    public function atualizarConsumoAgua($dadosConsumo, $consumoId)
    {
        $consumo = $this->consumoAguaRepository->find($consumoId);
        if ($consumo) {
            $this->consumoAguaRepository->update($consumoId, $dadosConsumo);
            return response()->json(["sucesso" => "Consumo de água atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Consumo de água não encontrado"], 400);
    }
}
