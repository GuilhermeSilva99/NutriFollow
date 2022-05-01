<?php

namespace App\Services;

use App\Repository\{NutricionistaRepository, UserRepository};

class AdminService
{
    protected $nutricionistaRepository;
    protected $userRepository;

    public function __construct(UserRepository $userRepository, NutricionistaRepository $nutricionistaRepository)
    {
        $this->userRepository = $userRepository;
        $this->nutricionistaRepository = $nutricionistaRepository;
    }

    public function index()
    {
        return $this->nutricionistaRepository->listarNutricionistasComCadastroAprovado();
    }

    public function listarNutricionistas()
    {
        return $this->nutricionistaRepository->listarNutricionistasComCadastroAprovado();
    }

    public function inativarNutricionista($id)
    {
        $nutricionista = $this->nutricionistaRepository->findByColumn("user_id", $id)->first();
        $nutricionistaUsuario = $nutricionista->user;
        $nutricionistaUsuario->cadastro_aprovado = false;
        $this->userRepository->saveWithModel($nutricionistaUsuario);
        $this->nutricionistaRepository->softDelete($nutricionista);
        $this->userRepository->softDelete($nutricionistaUsuario);
    }

    public function listarNutricionistasInativos()
    {
        return $this->userRepository->listarNutricionistasInativos();
    }

    public function reativarNutricionista($id)
    {
        $nutricionistaUsuario = $this->userRepository->findWithTrashed($id);
        $nutricionista = $this->nutricionistaRepository->findWithTrashedUserId($id);

        $this->userRepository->restore($nutricionista);
        $this->userRepository->restore($nutricionistaUsuario);

        $nutricionistaUsuario->cadastro_aprovado = true;

        $this->userRepository->saveWithModel($nutricionista);
        $this->userRepository->saveWithModel($nutricionistaUsuario);
    }

    public function ativarCadastro($id)
    {
        $nutricionistaUsuario = $this->userRepository->find($id);
        $nutricionistaUsuario->cadastro_aprovado = 1;
        $this->userRepository->saveWithModel($nutricionistaUsuario);
    }

    public function recusarCadastro($id)
    {
        $nutricionista = $this->nutricionistaRepository->findByColumn("user_id", $id)->first();
        $nutricionistaUsuario = $nutricionista->user;
        if (!$nutricionistaUsuario) {
            return false;
        }
        $this->nutricionistaRepository->softDelete($nutricionista);
        $this->userRepository->softDelete($nutricionistaUsuario);
        return true;
    }
}
