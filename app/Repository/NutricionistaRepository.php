<?php

namespace App\Repository;

use App\Models\Nutricionista;

class NutricionistaRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Nutricionista::all();
    }

    public function find($id)
    {
        return Nutricionista::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return Nutricionista::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return Nutricionista::create($atributos);
    }

    public function update($id, $atributos)
    {
        return Nutricionista::find($id)->update($atributos);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function softDelete($objeto)
    {
        return $objeto->delete();
    }

    public function findWithTrashedUserId($id)
    {
        return Nutricionista::onlyTrashed()->where('user_id', $id)->first();
    }

    public function listarNutricionistasInativos()
    {
        return Nutricionista::onlyTrashed()->where('cadastro_aprovado', 2)->get();
    }

    public function listarNutricionistasComCadastroPendente()
    {
        return Nutricionista::whereRelation('user', 'cadastro_aprovado', 0)
            ->whereRelation('user', 'email_verified_at', "!=", null)->get();
    }

    public function listarNutricionistasComCadastroAprovado()
    {
        return Nutricionista::whereRelation('user', 'cadastro_aprovado', 0)->get();
    }
}
