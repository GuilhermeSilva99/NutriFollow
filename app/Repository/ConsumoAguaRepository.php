<?php

namespace App\Repository;

use App\Models\ConsumoAgua;

class ConsumoAguaRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return ConsumoAgua::all();
    }

    public function find($id)
    {
        return ConsumoAgua::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return ConsumoAgua::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        $nutricionista = ConsumoAgua::create($atributos);
        return $nutricionista->save();
    }

    public function update($id, $atributos)
    {
        return ConsumoAgua::find($id)->update($atributos);
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
