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

    public function index()
    {
        return view('paciente.create-paciente');
    }

    public function salvarPaciente(StorePacienteRequest $request)
    {
        try {
            $data = $request->validated();
            $this->nutricionistaService->save($data);
            return redirect('/nutricionista/listar/pacientes');
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function listarPacientes()
    {
        try {
            $pacientes = $this->nutricionistaService->listarPacientes();
            return view('paciente.list-paciente', ['pacientes' => $pacientes]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function exibirPaciente($id)
    {
        try {
            $paciente = $this->nutricionistaService->exibirPaciente($id);
            return view('paciente.view-paciente', ['paciente' => $paciente]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function editarPaciente($id)
    {
        try {
            $paciente = $this->nutricionistaService->editarPaciente($id);
            return view('paciente.edit-paciente', ['paciente' => $paciente]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function atualizarPaciente(UpdatePacienteRequest $request, $id)
    {
        try {
            $dadosValidados = $request->validated();
            $this->nutricionistaService->editar($dadosValidados, $id);
            return redirect('/nutricionista/listar/pacientes');
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function editarSenha($id)
    {
        try {
            $paciente = $this->nutricionistaService->editarSenha($id);
            return view('paciente.edit-password', ['paciente' => $paciente]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function atualizarSenha(ResetPasswordRequest $request, $id)
    {
        try {
            $dados = $request->validated();
            $this->nutricionistaService->atualizarSenha($dados, $id);
            return redirect('/nutricionista/listar/pacientes');
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function inativarPaciente($id)
    {
        $this->nutricionistaService->inativarPaciente($id);
        return redirect()->route('nutricionista.listar.pacientes');
    }
}
