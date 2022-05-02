<?php

namespace App\Repository;

use App\Models\Paciente;

class PacienteRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Paciente::all();
    }

    public function find($id)
    {
        return Paciente::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Paciente::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Paciente::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Paciente::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function findByColumnWithUser($coluna, $valor)
    {
        return Paciente::with("user")->where($coluna, $valor)->get();
    }
}
