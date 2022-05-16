<?php

namespace App\Repository;

use App\Models\{Medida, Paciente};

class MedidaRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Medida::all();
    }

    public function find($id)
    {
        return Medida::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Medida::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Medida::create($atributos);
    }

    public function saveByUserId($atributos)
    {
        $paciente_id = Paciente::where('user_id', $atributos['paciente_id'])->whereRelation('user', 'deleted_at', null)->first()->id;
        $atributos['paciente_id'] = $paciente_id;
        return Medida::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Medida::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function updateWithModel($objeto, $atributos)
    {
        return $objeto->update($atributos);
    }

    public function findByPeriod($inicio, $fim, $paciente_id)
    {
        return Medida::where('paciente_id', $paciente_id)->whereBetween('data', [$inicio, $fim])->orderBy('data', 'asc')->paginate(10);
    }

    public function findByPaciente($paciente_id)
    {
        return Medida::where('paciente_id', $paciente_id)->orderBy('data', 'desc')->paginate(10);
    }

    public function findByUserId($user_id)
    {
        $paciente_id = Paciente::where('user_id', $user_id)->whereRelation('user', 'deleted_at', null)->first()->id;
        return $this->findByPaciente($paciente_id);
    }
}
