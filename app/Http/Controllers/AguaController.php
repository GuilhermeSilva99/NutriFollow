<?php

namespace App\Http\Controllers;

use App\Services\ConsumoAguaService;
use Illuminate\Http\Request;

class AguaController extends Controller
{
    private $aguaService;

    public function __construct(ConsumoAguaService $aguaService)
    {
        $this->aguaService = $aguaService;
    }

    public function index(Request $request, $id)
    {
        $registrosAgua = $this->aguaService->listarConsumoAguaPorPeriodo($request->inicio, $request->fim, $id);

        $dias = [];
        $quantidade = [];
        
        foreach ($registrosAgua as $consumoAgua)
        {
            $dias[] = date('d-m-y', strtotime($consumoAgua->data)); 
            $quantidade[] = floatval($consumoAgua->quantidade);
        }

        $quantidade_data = ['name' => 'Consumo de Água','data' => $quantidade];

        return view('paciente.agua', ['dias' => json_encode($dias),
                                      'quantidade' => json_encode($quantidade_data),
                                      'id' => $id]);
    }
}
