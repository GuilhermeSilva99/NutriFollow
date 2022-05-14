<?php

namespace App\Repository;

use App\Models\RefeicaoPaciente;
use Illuminate\Support\Facades\DB;

class RefeicaoPacienteRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return RefeicaoPaciente::all();
    }

    public function find($id)
    {
        return RefeicaoPaciente::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return RefeicaoPaciente::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return RefeicaoPaciente::create($atributos);
    }

    public function update($id, $atributos)
    {
        return RefeicaoPaciente::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function updateWithModel($objeto, $atributos)
    {
        return $objeto->update($atributos);
    }

    public function findByColumnWithRefeicao($coluna, $valor)
    {
        return RefeicaoPaciente::with('refeicao')->where($coluna, $valor)->get();
    }

    public function findRefeicoesByDietaId($dietaId, $pacienteId)
    {
        return DB::table("refeicao_pacientes")
            ->join("refeicaos", "refeicao_pacientes.refeicao_id", "=", "refeicaos.id")
            ->select("refeicaos.*", "refeicao_pacientes.foto", "refeicao_pacientes.observacoes")
            ->where("refeicaos.dieta_id", "=", $dietaId)
            ->where("refeicao_pacientes.id", "=", $pacienteId)
            ->groupBy("refeicaos.id", "refeicao_pacientes.foto", "refeicao_pacientes.observacoes")
            ->get();
    }

    public function findRefeicaoByPacienteId($refeicaoId)
    {
        return DB::table("refeicao_pacientes")
            ->join("refeicaos", "refeicao_pacientes.refeicao_id", "=", "refeicaos.id")
            ->select("refeicaos.*", "refeicao_pacientes.foto", "refeicao_pacientes.observacoes")
            ->where("refeicao_pacientes.refeicao_id", $refeicaoId)
            ->where("refeicaos.id", $refeicaoId)
            ->groupBy("refeicaos.id", "refeicao_pacientes.foto", "refeicao_pacientes.observacoes")
            ->get();
    }
}
