<?php

namespace App\Repository;

interface BaseRepositoryInterface
{
    public function all();

    public function find($id);

    public function findByColumn($coluna, $valor);

    public function save($atributos);

    public function update($id, $atributos);

    public function deleteById($id);

    public function softDelete($objeto);
}
