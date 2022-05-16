<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreComorbidadeRequest;
use App\Http\Requests\StoreExameRequest;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdateComorbidadeRequest;
use App\Http\Requests\UpdateExameRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Services\NutricionistaService;
use Illuminate\Http\Request;

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

    //Comorbidade

    public function criarComorbidadePaciente($id)
    {
        return view('comorbidade.cadastro-comorbidade-paciente', ['id' => $id]);
    }

    public function salvarComorbidadePaciente(StoreComorbidadeRequest $request)
    {
        $dados = $request->validated();
        $this->nutricionistaService->salvarComorbidadePaciente($dados);
        return redirect()->route('nutricionista.listar.comorbidade.paciente', $dados["paciente_id"]);
    }

    public function listarComorbidadesPaciente(Request $request)
    {
        $comorbidades = $this->nutricionistaService->listarComorbidades($request->id);
        return view('comorbidade.lista-comorbidades-paciente', ['comorbidades' => $comorbidades, 'id' => $request->id]);
    }

    public function editarComorbidadePaciente($comorbidadeID)
    {
        $comorbidade = $this->nutricionistaService->recuperarComorbidade($comorbidadeID);
        return view('comorbidade.edita-comorbidade-paciente', ["comorbidade" => $comorbidade]);
    }

    public function atualizarComorbidadePaciente(UpdateComorbidadeRequest $request)
    {
        $dados = $request->validated();
        $this->nutricionistaService->atualizarComorbidadePaciente($dados, $request->id);
        $comorbidade = $this->nutricionistaService->recuperarComorbidadePaciente($request->id);
        return redirect()->route('nutricionista.listar.comorbidade.paciente', $comorbidade->paciente_id);
    }

    public function deletarComorbidadePaciente($comorbidadeID)
    {
        $comorbidade = $this->nutricionistaService->recuperarComorbidadePaciente($comorbidadeID);
        $this->nutricionistaService->deletarComorbidadePaciente($comorbidadeID);
        return redirect()->route('nutricionista.listar.comorbidade.paciente', $comorbidade->paciente_id);
    }

    public function consulta()
    {
        $pacientes = $this->nutricionistaService->listarPacientes();
        return view('consulta.selecionar-paciente', ["pacientes" => $pacientes]);
    }

    public function cadastrarExamePaciente($id)
    {
        return view('consulta.cadastro-exame-paciente', ["id" => $id]);
    }

    public function salvarExamePaciente(StoreExameRequest $request)
    {
        $dados = $request->validated();
        $this->nutricionistaService->salvarExamePaciente($dados);

        return view('consulta.cadastro-exame-paciente', ["id" => $request->paciente_id]);
    }

    public function listarExamePaciente(Request $request)
    {
        $exames = $this->nutricionistaService->listarExames($request->id);
        return view('consulta.lista-exames-paciente', ['exames' => $exames, 'id' => $request->id]);
    }

    public function editarExamePaciente($exame_id)
    {
        $exame = $this->nutricionistaService->recuperarExame($exame_id);
        return view('consulta.edita-exame-paciente', ["exame" => $exame]);
    }

    public function atualizarExamePaciente(UpdateExameRequest $request)
    {
        $dados = $request->validated();
        $this->nutricionistaService->atualizarExamePaciente($dados, $request->id);
        $exame = $this->nutricionistaService->recuperarExame($request->id);
        return redirect()->route('nutricionista.listar.exame.paciente', $exame->paciente_id);
    }

    public function deletarExamePaciente($exame_id)
    {
        $exame = $this->nutricionistaService->recuperarExame($exame_id);
        $this->nutricionistaService->deletarExamePaciente($exame_id);
        return redirect()->route('nutricionista.listar.exame.paciente', $exame->paciente_id);
    }
}
