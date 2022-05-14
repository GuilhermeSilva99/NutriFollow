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

    public function softDelete($paciente)
    {
        return $paciente->user()->delete();
    }

    public function findByColumnWithUser($coluna, $valor)
    {
        return Paciente::whereRelation('user', 'deleted_at', null)->where($coluna, $valor)->paginate(7);
    }

    public function updateWithModel($sono, $atributos)
    {
        return $sono->update($atributos);
    }
}
