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
        return view("medida.list-medidas", ['id'=>$id, 'medidas' => $medidas]);
    }

    public function delete($paciente_id, $id)
    {
        $this->medidaService->delete($id);
        return redirect()->route('medida', $paciente_id);
    }

    public function adicionarMedida($paciente_id, Request $request)
    {
        $dados = $request->all();
        $this->medidaService->create($dados, $paciente_id);
        return redirect()->route('medida', $paciente_id);
    }

    public function editarMedida($paciente_id, $id, Request $request)
    {
        $dados = $request->all();
        $this->medidaService->save($dados, $id);
        return redirect()->route('medida', $paciente_id);
    }
}
