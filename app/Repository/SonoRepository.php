<?php

namespace App\Repository;

use App\Models\Sono;

class SonoRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Sono::all();
    }

    public function find($id)
    {
        return Sono::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Sono::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        $nutricionista = Sono::create($atributos);
        return $nutricionista->save();
    }

    public function update($id, $atributos)
    {
        return Sono::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }
}