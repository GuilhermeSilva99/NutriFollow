<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SonoService;

class SonoController extends Controller
{
    private $sonoService;

    public function __construct(SonoService $sonoService)
    {
        $this->sonoService = $sonoService;
    }

    public function index($id)
    {
        $registros_sono = $this->sonoService->listarSono($id);
        $status = ["Bom" => 10, "Mediano" => 5, "Ruim" => 0];
        $dias = [];
        $duracao = [];
        $qualidade = [];
        
        foreach ($registros_sono as $sono)
        {
            $dias[] = date('d-m', strtotime($sono->data)); 
            $duracao[] = floatval($sono->duracao);
            $qualidade[] = floatval($status[$sono->avaliacao]);
        }


        $duracao_data = ['name' => 'Tempo de sono','data' => $duracao];
        $qualidade_data = ['name' => 'Qualidade', 'data' => $qualidade];
        return view('paciente.sono', ['dias' => json_encode($dias), 'duracao' => json_encode($duracao_data), 'qualidade' => json_encode($qualidade_data)]);
    }
}
