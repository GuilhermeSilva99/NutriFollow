<?php

namespace App\Services;

use App\Repository\ConsumoAguaRepository;
use Carbon\Carbon;
use App\Repository\UserRepository;

class ConsumoAguaService
{
    private $consumoAguaRepository;

    public function __construct(UserRepository $userRepository, ConsumoAguaRepository $consumoAguaRepository)
    {
        $this->consumoAguaRepository = $consumoAguaRepository;
        $this->userRepository = $userRepository;
    }

    public function listarConsumoAgua($pacienteID)
    {
        return $this->consumoAguaRepository->findByColumn("paciente_id", $pacienteID);
    }

    public function criarConsumoAgua($dadosConsumo, $pacienteID)
    {
        $data = Carbon::parse($dadosConsumo["data"]);
        $consumoAgua = $this->consumoAguaRepository->findByColumn("data", $data);

        if (count($consumoAgua) >= 1)
            return response()->json(["erro" => "Já existe um consumo de água nessa data"], 400);

        $dadosConsumo['paciente_id'] = $pacienteID;
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
            $this->consumoAguaRepository->updateWithModel($consumo, $dadosConsumo);
            return response()->json(["sucesso" => "Consumo de água atualizado com sucesso!"], 200);
        }

        return response()->json(["erro" => "Consumo de água não encontrado"], 400);
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
