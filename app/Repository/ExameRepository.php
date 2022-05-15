<?php

namespace App\Repository;

use App\Models\Exame;

class ExameRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Exame::all();
    }

    public function find($id)
    {
        return Exame::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Exame::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Exame::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Exame::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function delete($exameId)
    {
        return Exame::destroy($exameId);
    }

    public function updateWithModel($consumo, $atributos)
    {
        return $consumo->update($atributos);
    }
}
