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

    public function listarMedidas($paciente_id, $inicio, $fim)
    {
        Carbon::setlocale('pt-BR');
        if ($inicio == null || $fim == null) {
            $fim = Carbon::now();
            $inicio = Carbon::now()->sub(30, 'days');
        }

        return $this->medidaRepository->findByPeriod($inicio, $fim, $paciente_id);
    }

    public function delete($id)
    {
        return $this->medidaRepository->deleteById($id);
    }

    public function create($dados, $id)
    {
        $dados['paciente_id'] = $id;
        return $this->medidaRepository->save($dados);
    }

    public function save($dados, $id)
    {
        return $this->medidaRepository->update($id, $dados);
    }

}
