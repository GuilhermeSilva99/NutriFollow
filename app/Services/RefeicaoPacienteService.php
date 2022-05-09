<?php

namespace App\Services;

use App\Repository\{DietaRepository, RefeicaoPacienteRepository, RefeicaoRepository};
use Carbon\Carbon;

class RefeicaoPacienteService
{
    private $refeicaoPacienteRepository;
    private $dietaRepository;

    public function __construct(
        RefeicaoPacienteRepository $refeicaoPacienteRepository,
        RefeicaoRepository $refeicaoRepostiory,
        DietaRepository $dietaRepository
    ) {
        $this->refeicaoPacienteRepository = $refeicaoPacienteRepository;
        $this->refeicaoRepostiory = $refeicaoRepostiory;
        $this->dietaRepository = $dietaRepository;
    }

    public function listarRefeicaoDoPaciente($pacienteID)
    {
        $dataAtual = Carbon::now()->toDateString();
        $dieta = $this->dietaRepository->findByPeriodPaciente($pacienteID, $dataAtual);
        return $this->refeicaoRepostiory
            ->findByColumnWithFields("dieta_id", $dieta->id, ["id", "nome_refeicao", "horario", "descricao_refeicao"]);
    }

    public function criarRefeicaoPaciente($dadosRefeicao, $pacienteID)
    {
        $dadosRefeicao['paciente_id'] = $pacienteID;
        $this->refeicaoPacienteRepository->save($dadosRefeicao);

        return response()->json(["sucesso" => "Refeição cadastrada com sucesso!"], 200);
    }

    public function recuperarRefeicaoDoPaciente($refeicaoDoPacienteId)
    {
        $refeicao = $this->refeicaoRepostiory->find($refeicaoDoPacienteId);
        if ($refeicao)
            return $refeicao;

        return response()->json(["erro" => "Refeição não encontrada"], 400);
    }

    public function recuperarRefeicaoPaciente($refeicaoPacienteId)
    {
        $refeicao = $this->refeicaoPacienteRepository->find($refeicaoPacienteId);
        if ($refeicao)
            return $refeicao;

        return response()->json(["erro" => "Refeição não encontrada"], 400);
    }

    public function atualizarRefeicaoPaciente($dadosConsumo, $refeicaoPacienteId)
    {
        $consumo = $this->refeicaoPacienteRepository->find($refeicaoPacienteId);
        if ($consumo) {
            $this->refeicaoPacienteRepository->update($refeicaoPacienteId, $dadosConsumo);
            return response()->json(["sucesso" => "Refeição atualizada com sucesso!"], 200);
        }

        return response()->json(["erro" => "Refeição não encontrado"], 400);
    }
}
