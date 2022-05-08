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
        $exercicio = Exercicio::create($atributos);
        return $exercicio->save();
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
}
