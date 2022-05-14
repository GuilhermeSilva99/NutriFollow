<?php

namespace App\Services;

use App\Repository\{DietaRepository, RefeicaoNutricionistaRepository, RefeicaoPacienteRepository, RefeicaoRepository};
use Carbon\Carbon;

class RefeicaoPacienteService
{
    private $refeicaoRepostiory;
    private $refeicaoPacienteRepostiory;
    private $refeicaoNutricionistaRepostiory;
    private $dietaRepository;

    public function __construct(
        RefeicaoRepository $refeicaoRepostiory,
        RefeicaoPacienteRepository $refeicaoPacienteRepostiory,
        RefeicaoNutricionistaRepository $refeicaoNutricionistaRepostiory,
        DietaRepository $dietaRepository
    ) {
        $this->refeicaoRepostiory = $refeicaoRepostiory;
        $this->refeicaoPacienteRepostiory = $refeicaoPacienteRepostiory;
        $this->refeicaoNutricionistaRepostiory = $refeicaoNutricionistaRepostiory;
        $this->dietaRepository = $dietaRepository;
    }

    public function listarRefeicaoDoNutricionista($pacienteID)
    {
        $dataAtual = Carbon::now()->toDateString();
        $dieta = $this->dietaRepository->findByPeriodPaciente($pacienteID, $dataAtual);
        return $this->refeicaoNutricionistaRepostiory->findRefeicoesByDietaId($dieta->id);
    }

    public function listarRefeicaoDoPaciente($pacienteID)
    {
        $dataAtual = Carbon::now()->toDateString();
        $dieta = $this->dietaRepository->findByPeriodPaciente($pacienteID, $dataAtual);
        return $this->refeicaoPacienteRepostiory->findRefeicoesByDietaId($dieta->id, $pacienteID);
    }

    public function criarRefeicaoPaciente($dadosRefeicao, $pacienteID)
    {
        $dadosRefeicao["paciente_id"] = $pacienteID;

        $refeicao = $this->refeicaoRepostiory->save($dadosRefeicao);
        $this->refeicaoPacienteRepostiory->save([
            "paciente_id" => $pacienteID, "refeicao_id" => $refeicao->id,
            "refeicao_referencia_id" => $dadosRefeicao["refeicao_referencia_id"],
            "foto" => $dadosRefeicao["foto"], "observacoes" => $dadosRefeicao["observacoes"]
        ]);

        return response()->json(["sucesso" => "Refeição cadastrada com sucesso!"], 200);
    }

    public function recuperarRefeicaoPaciente($refeicaoId)
    {
        $refeicao = $this->refeicaoPacienteRepostiory->findRefeicaoByPacienteId($refeicaoId);
        if (count($refeicao) >= 1)
            return $refeicao;

        return response()->json(["erro" => "Refeição não encontrada"], 400);
    }

    public function atualizarRefeicaoPaciente($dadosRefeicao, $refeicaoPacienteId)
    {
        $refeicaoPaciente = $this->refeicaoPacienteRepostiory->findByColumn("refeicao_id", $refeicaoPacienteId)->first();
        if ($refeicaoPaciente) {
            $refeicao = $this->refeicaoRepostiory->find($refeicaoPacienteId);
            $this->refeicaoRepostiory->updateWithModel($refeicao, $dadosRefeicao);
            $this->refeicaoPacienteRepostiory->updateWithModel($refeicaoPaciente, $dadosRefeicao);
            return response()->json(["sucesso" => "Refeição atualizada com sucesso!"], 200);
        }

        return response()->json(["erro" => "Refeição não encontrado"], 400);
    }
}
