<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MedidaService;

class MedidaController extends Controller
{
    private $medidaService;

    public function __construct(MedidaService $medidaService)
    {
        $this->medidaService = $medidaService;
    }
    public function index($id)
    {
        $medidas = $this->medidaService->listarMedidas($id);
        return view("medida.list-medidas", ['medidas' => $medidas]);
    }
}
