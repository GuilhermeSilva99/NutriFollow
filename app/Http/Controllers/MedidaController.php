<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedidaRequest;
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
        return redirect()->route('medida', $paciente_id)->with('mensagem-delete', 'Medida excluida com sucesso!');
    }

    public function adicionarMedida($paciente_id, StoreMedidaRequest $request)
    {
        $dados = $request->validated();
        $this->medidaService->create($dados, $paciente_id);
        return redirect()->route('medida', $paciente_id)->with('mensagem', 'Medida cadastrada com sucesso!');
    }

    public function editarMedida($paciente_id, $id, StoreMedidaRequest $request)
    {
        $dados = $request->validated();
        $this->medidaService->save($dados, $id);
        return redirect()->route('medida', $paciente_id)->with('mensagem', 'As medidas do paciente foram atualizadas com sucesso!');
    }
}
