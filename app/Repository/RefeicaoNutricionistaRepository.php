<?php

namespace App\Repository;

use App\Models\RefeicaoNutricionista;
use Illuminate\Support\Facades\DB;

class RefeicaoNutricionistaRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return RefeicaoNutricionista::all();
    }

    public function find($id)
    {
        return RefeicaoNutricionista::find($id);
    }

    public function findByColumn($coluna, $valor)
    {
        return RefeicaoNutricionista::where($coluna, $valor)->get();
    }

    public function save($atributos)
    {
        return RefeicaoNutricionista::create($atributos);
    }

    public function update($id, $atributos)
    {
        return RefeicaoNutricionista::find($id)->update($atributos);
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

    public function findByColumnWithRefeicao($coluna, $valor)
    {
        return RefeicaoNutricionista::with('refeicao')->where($coluna, $valor)->get();
    }

    public function findRefeicoesByDietaId($dietaId)
    {
        return DB::table("refeicao_nutricionistas")
            ->join("refeicaos", "refeicao_nutricionistas.refeicao_id", "=", "refeicaos.id")
            ->select("refeicaos.*")
            ->where("refeicaos.dieta_id", $dietaId)
            ->groupBy("refeicaos.id")
            ->get();
    }
}
