<?php

namespace App\Services;

use App\Repository\{DietaRepository, RefeicaoNutricionistaRepository, RefeicaoPacienteRepository, RefeicaoRepository};
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        if (array_key_exists("foto", $dadosRefeicao) && !is_null($dadosRefeicao["foto"]))
            $dadosRefeicao["foto"] = $this->salvarFotoPaciente($dadosRefeicao["foto"], $pacienteID);

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

    public function atualizarRefeicaoPaciente($dadosRefeicao, $refeicaoId)
    {
        $refeicaoPaciente = $this->refeicaoPacienteRepostiory->findByColumn("refeicao_id", $refeicaoId)->first();
        if ($refeicaoPaciente) {
            $refeicao = $this->refeicaoRepostiory->find($refeicaoId);

            if (array_key_exists("foto", $dadosRefeicao) && !is_null($dadosRefeicao["foto"])) {
                $dadosRefeicao["foto"] = $this->salvarFotoPaciente($dadosRefeicao["foto"], $refeicaoPaciente->paciente_id);
                Storage::delete('public/' . $refeicaoPaciente->foto);
            }

            $this->refeicaoRepostiory->updateWithModel($refeicao, $dadosRefeicao);
            $this->refeicaoPacienteRepostiory->updateWithModel($refeicaoPaciente, $dadosRefeicao);
            return response()->json(["sucesso" => "Refeição atualizada com sucesso!"], 200);
        }

        return response()->json(["erro" => "Refeição não encontrada"], 400);
    }

    public function deletarRefeicaoPaciente($refeicaoId)
    {
        $refeicaoPaciente = $this->refeicaoPacienteRepostiory->findByColumn("refeicao_id", $refeicaoId)->first();
        if ($refeicaoPaciente) {
            Storage::delete('public/' . $refeicaoPaciente->foto);
            $this->refeicaoPacienteRepostiory->deleteById($refeicaoPaciente->id);
            $this->refeicaoRepostiory->deleteById($refeicaoPaciente->refeicao_id);
            return response()->json(["sucesso" => "Refeição deletada com sucesso!"], 200);
        }

        return response()->json(["erro" => "Refeição não encontrada"], 400);
    }

    public function salvarFotoPaciente($foto, $pacienteID)
    {
        $extensaoImagem = explode('/', mime_content_type($foto))[1];
        $imagem = base64_decode(explode(";base64,", $foto)[1]);
        $caminhoImagem = "/refeicoes/paciente/" . $pacienteID . "/" . Str::uuid()->toString() . "." . $extensaoImagem;

        Storage::put("public" . $caminhoImagem, $imagem);

        return $caminhoImagem;
    }
}
