<?php

namespace App\Repository;

use App\Models\User;

class UserRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return User::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return User::create($atributos);
    }

    public function update($id, $atributos)
    {
        return User::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->softDelete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function refresh($usuario)
    {
        return $usuario->refresh();
    }

    public function restore($usuario)
    {
        return $usuario->restore();
    }

    public function saveWithModel($usuario)
    {
        return $usuario->save();
    }

    public function findWithTrashed($id)
    {
        return User::onlyTrashed()->where('id', $id)->first();
    }

    public function listarNutricionistasInativos()
    {
        return User::onlyTrashed()->where('tipo_usuario', 2)->get();
    }
}
