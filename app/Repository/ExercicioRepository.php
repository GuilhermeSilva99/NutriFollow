<?php

namespace App\Repository;

use App\Models\Exercicio;

class ExercicioRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Exercicio::all();
    }

    public function find($id)
    {
        return Exercicio::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Exercicio::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Exercicio::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Exercicio::find($id)->update($atributos);
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

    public function findByColumnExceptConsumo($coluna, $valor, $id)
    {
        return Exercicio::where($coluna, $valor)->where("id", "!=", $id)->get();
    }

    public function findByPeriod($inicio, $fim, $paciente_id)
    {
        return Exercicio::where('paciente_id', $paciente_id)->whereBetween('data', [$inicio, $fim])->orderBy('data', 'asc')->get();
    }
}
