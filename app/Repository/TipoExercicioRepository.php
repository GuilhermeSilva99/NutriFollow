<?php

namespace App\Repository;

use App\Models\TipoExercicio;

class TipoExercicioRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return TipoExercicio::all();
    }

    public function find($id)
    {
        return TipoExercicio::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return TipoExercicio::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return TipoExercicio::create($atributos);;
    }

    public function update($id, $atributos)
    {
        return TipoExercicio::find($id)->update($atributos);
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
