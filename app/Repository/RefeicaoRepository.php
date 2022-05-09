<?php

namespace App\Repository;

use App\Models\Refeicao;

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
        $nutricionista = Refeicao::create($atributos);
        return $nutricionista->save();
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

    public function findByColumnWithFields($coluna, $valor, $fields)
    {
        return Refeicao::where($coluna, $valor)->get($fields);
    }
}
