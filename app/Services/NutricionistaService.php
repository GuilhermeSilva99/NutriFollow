<?php

namespace App\Services;

use App\Repository\NutricionistaRepository;
use App\Repository\PacienteRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NutricionistaService
{
    private $pacienteRepository;
    private $nutricionistaRepository;
    private $userRepository;

    public function __construct(PacienteRepository $pacienteRepository, NutricionistaRepository $nutricionistaRepository, UserRepository $userRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
        $this->nutricionistaRepository = $nutricionistaRepository;
        $this->userRepository = $userRepository;
    }

    public function save($atributosPaciente)
    {
        $dadosUsuario = $atributosPaciente;
        $dadosUsuario['password'] = Hash::make($atributosPaciente['password']);
        $dadosUsuario['tipo_usuario'] = 3;
        $dadosUsuario['cadastro_aprovado'] = 1;

        $usuarioPaciente = $this->userRepository->save($dadosUsuario);

        $nutricionista = $this->nutricionistaRepository->findByColumn("user_id", Auth::user()->id)->first();

        $dadosPaciente = [
            "sexo" => $dadosUsuario['sexo-select'] ?? $dadosUsuario['sexo-input'],
            "observacoes" => $dadosUsuario['obs'], "user_id" => $usuarioPaciente->id, "nutricionista_id" => $nutricionista->id
        ];

        $this->pacienteRepository->save($dadosPaciente);
    }

    public function listarPacientes()
    {
        $nutricionista = $this->nutricionistaRepository->findByColumn("user_id", Auth::user()->id)->first();
        return $this->pacienteRepository->findByColumnWithUser('nutricionista_id', $nutricionista->id);
    }

    public function exibirPaciente($id)
    {
        return $this->pacienteRepository->findByColumnWithUser('user_id', $id)->first();
    }

    public function editarPaciente($id)
    {
        return $this->pacienteRepository->findByColumnWithUser('user_id', $id)->first();
    }

    public function editar($dados, $id)
    {
        $paciente = $this->pacienteRepository->findByColumnWithUser('user_id', $id)->first();
        $paciente->user->nome = $dados['nome'];
        $paciente->user->email = $dados['email'];
        $paciente->user->cpf = $dados['cpf'];
        $paciente->user->telefone_1 = $dados['telefone_1'];
        $paciente->user->telefone_2 = $dados['telefone_2'];

        $this->userRepository->saveWithModel($paciente->user);

        $paciente->sexo = $dados['sexo-select'] ?? $dados['sexo-input'];
        $paciente->observacoes = $dados['obs'];

        $this->userRepository->saveWithModel($paciente);
    }

    public function editarSenha($id)
    {
        return $this->pacienteRepository->findByColumnWithUser('user_id', $id)->first();
    }

    public function atualizarSenha($dados, $id)
    {
        $paciente = $this->pacienteRepository->findByColumnWithUser('user_id', $id)->first();
        $paciente->user->password = Hash::make($dados['password']);
        $this->userRepository->saveWithModel($paciente->user);
    }

    public function inativarPaciente($id)
    {
        $paciente = $this->pacienteRepository->find($id);
        $this->pacienteRepository->softDelete($paciente);
    }
}
