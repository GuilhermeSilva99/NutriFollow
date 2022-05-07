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

    public function findByPeriod($inicio, $fim, $paciente_id)
    {
        return Sono::where('paciente_id', $paciente_id)->whereDate('data','>=', $inicio)->whereDate('data','<=', $fim)->get();
    }
}
