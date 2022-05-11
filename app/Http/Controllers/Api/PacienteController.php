<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePacienteAPIRequest;
use App\Services\PacienteService;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    private $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function minhasInformacoes(Request $request)
    {
        return $request->user();
    }

    public function atualizarInformacoes(UpdatePacienteAPIRequest $request)
    {
        $dados = $request->validated();
        return $this->pacienteService->atualizarInformacoes($dados, $request->user()->paciente->id);
    }
}
