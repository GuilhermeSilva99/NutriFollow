<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SonoService;
use Carbon\Carbon;

class SonoController extends Controller
{
    private $sonoService;

    public function __construct(SonoService $sonoService)
    {
        $this->sonoService = $sonoService;
    }

    public function index(Request $request, $id)
    {
        $inicio = Carbon::parse($request->inicio)->format('y-m-d');
        $fim = Carbon::parse($request->fim)->format('y-m-d');
        
        if($request->inicio == null || $request->fim == null)
            $registros_sono = $this->sonoService->listarSono($id);
        else
            $registros_sono = $this->sonoService->listarSonoPorPeriodo($inicio, $fim, $id);

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
        return view('paciente.sono', ['dias' => json_encode($dias),
                                      'duracao' => json_encode($duracao_data),
                                      'qualidade' => json_encode($qualidade_data),
                                      'id' => $id]);
    }
}
