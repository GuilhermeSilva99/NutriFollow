<?php

namespace App\Repository;

use App\Models\Comorbidade;

class ComorbidadeRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Comorbidade::all();
    }

    public function find($id)
    {
        return Comorbidade::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Comorbidade::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Comorbidade::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Comorbidade::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function delete($comorbidadeId)
    {
        return Comorbidade::destroy($comorbidadeId);
    }

    public function updateWithModel($consumo, $atributos)
    {
        return $consumo->update($atributos);
    }
}
