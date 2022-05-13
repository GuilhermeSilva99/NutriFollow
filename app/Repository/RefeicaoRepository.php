<?php

namespace App\Repository;

use App\Models\Refeicao;
use Illuminate\Support\Facades\DB;

class RefeicaoRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Refeicao::all();
    }

    public function find($id)
    {
        return Refeicao::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Refeicao::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Refeicao::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Refeicao::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function findByColumnWithFields($coluna, $valor, $campos)
    {
        return Refeicao::where($coluna, $valor)->get($campos);
    }

    public function findByColumnFromNutricionista($coluna, $valor)
    {
        return Refeicao::where($coluna, $valor)->whereNotNull("nutricionista_id")->get();
    }

    public function findByColumnFromPaciente($coluna, $valor)
    {
        return Refeicao::where($coluna, $valor)->whereNotNull("paciente_id")->get();
    }

    public function updateWithModel($objeto, $atributos)
    {
        return $objeto->update($atributos);
    }
}
