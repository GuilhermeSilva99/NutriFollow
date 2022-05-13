<?php

namespace App\Services;

use App\Repository\{DietaRepository, RefeicaoRepository};
use Carbon\Carbon;

class RefeicaoPacienteService
{
    private $refeicaoRepostiory;
    private $dietaRepository;

    public function __construct(
        RefeicaoRepository $refeicaoRepostiory,
        DietaRepository $dietaRepository
    ) {
        $this->refeicaoRepostiory = $refeicaoRepostiory;
        $this->dietaRepository = $dietaRepository;
    }

    public function listarRefeicaoDoNutricionista($pacienteID)
    {
        $dataAtual = Carbon::now()->toDateString();
        $dieta = $this->dietaRepository->findByPeriodPaciente($pacienteID, $dataAtual);
        return $this->refeicaoRepostiory->findByColumnFromNutricionista("dieta_id", $dieta->id);
    }

    public function listarRefeicaoDoPaciente($pacienteID)
    {
        $dataAtual = Carbon::now()->toDateString();
        $dieta = $this->dietaRepository->findByPeriodPaciente($pacienteID, $dataAtual);
        return $this->refeicaoRepostiory->findByColumnFromPaciente("dieta_id", $dieta->id);
    }

    public function criarRefeicaoPaciente($dadosRefeicao, $pacienteID)
    {
        $dadosRefeicao["paciente_id"] = $pacienteID;

        $this->refeicaoRepostiory->save($dadosRefeicao);

        return response()->json(["erro" => "Refeição cadastrada com sucesso!"], 200);
    }

    public function recuperarRefeicaoPaciente($refeicaoPacienteId)
    {
        $refeicao = $this->refeicaoRepostiory->find($refeicaoPacienteId);
        if ($refeicao) {
            if ($refeicao->nutricionista_id)
                return response()->json(["erro" => "Refeição não pertence ao usuário!"], 400);

            return $refeicao;
        }

        return response()->json(["erro" => "Refeição não encontrada"], 400);
    }

    public function atualizarRefeicaoPaciente($dadosRefeicao, $refeicaoPacienteId)
    {
        $refeicaoPaciente = $this->refeicaoRepostiory->find($refeicaoPacienteId);
        if ($refeicaoPaciente) {
            if ($refeicaoPaciente->nutricionista_id)
                return response()->json(["sucesso" => "Refeição não pertence ao usuário!"], 400);

            $this->refeicaoRepostiory->updateWithModel($refeicaoPaciente, $dadosRefeicao);
            return response()->json(["sucesso" => "Refeição atualizada com sucesso!"], 200);
        }

        return response()->json(["erro" => "Refeição não encontrado"], 400);
    }
}
