<?php

namespace App\Repository;

use App\Models\Dieta;

class DietaRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Dieta::all();
    }

    public function find($id)
    {
        return Dieta::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Dieta::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Dieta::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Dieta::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function findByPeriodPaciente($pacienteId, $dataAtual)
    {
        return Dieta::where("paciente_id", $pacienteId)->where("data_inicio", "<=", $dataAtual)
            ->where("data_fim", ">=", $dataAtual)->first();
    }
}
