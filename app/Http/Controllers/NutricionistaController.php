<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Services\NutricionistaService;

class NutricionistaController extends Controller
{
    private $nutricionistaService;

    public function __construct(NutricionistaService $nutricionistaService)
    {
        $this->nutricionistaService = $nutricionistaService;
    }

    public function cadastroNaoConfirmado()
    {
        return view('nutricionista.cadastro-nao-confirmado');
    }

    public function cadastrarPaciente()
    {
        return view('nutricionista.cadastro-paciente');
    }

    public function storePaciente(StorePacienteRequest $request)
    {
        try {
            $data = $request->validated();
            $this->nutricionistaService->save($data);
            return redirect('/list/paciente');
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function list()
    {
        try {
            $pacientes = $this->nutricionistaService->list();
            return view('paciente.list-paciente', ['pacientes' => $pacientes]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function view($id)
    {
        try {
            $paciente = $this->nutricionistaService->view($id);
            return view('paciente.view-paciente', ['paciente' => $paciente]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function getEditar($id)
    {
        try {
            $paciente = $this->nutricionistaService->getEditar($id);
            return view('paciente.edit-paciente', ['paciente' => $paciente]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function editar(UpdatePacienteRequest $request, $id)
    {
        try {
            $dadosValidados = $request->validated();
            $this->nutricionistaService->editar($dadosValidados, $id);
            return redirect('/list/paciente');
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function edit_password($id)
    {
        try {
            $paciente = $this->nutricionistaService->edit_password($id);
            return view('paciente.edit-password', ['paciente' => $paciente]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function reset_password(ResetPasswordRequest $request, $id)
    {
        try {
            $dados = $request->validated();
            $this->nutricionistaService->reset_password($dados, $id);
            return redirect('/list/paciente');
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }
}
