<?php

namespace App\Services;

use App\Repository\MedidaRepository;
use Carbon\Carbon;

class MedidaService
{
    private $medidaRepository;

    public function __construct(MedidaRepository $medidaRepository)
    {
        $this->medidaRepository = $medidaRepository;
    }

    public function listarMedidas($user_id)
    {
        return $this->medidaRepository->findByUserId($user_id);
    }

    public function delete($id)
    {
        return $this->medidaRepository->deleteById($id);
    }

    public function create($dados, $id)
    {
        $dados['paciente_id'] = $id;
        return $this->medidaRepository->saveByUserId($dados);
    }

}
