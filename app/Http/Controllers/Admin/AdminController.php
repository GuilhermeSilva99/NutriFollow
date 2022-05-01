<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\AdminService;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $nutricionistas = $this->adminService->index();
        return view('admin.home', ['nutricionistas' => $nutricionistas]);
    }

    public function listaNutricionista()
    {
        $nutricionistas = $this->adminService->listarNutricionistas();
        return view('admin.lista-nutricionistas', ['nutricionistas' => $nutricionistas]);
    }

    public function inativar($id)
    {
        $this->adminService->inativarNutricionista($id);
        return redirect()->route('nutricionistas.listar');
    }

    public function listar_nutricionistas_inativos()
    {
        $users = $this->adminService->listarNutricionistasInativos();
        return view('admin.lista-nutricionistas-inativos', ['users' => $users]);
    }

    public function reativar($id)
    {
        $this->adminService->reativarNutricionista($id);
        return redirect()->Route('nutricionistas.inativos.listar');
    }

    public function ativarCadastro($id)
    {
        $this->adminService->ativarCadastro($id);
        return redirect()->route('admin.home');
    }

    public function recusarCadastro($id)
    {
        $usuario = $this->adminService->recusarCadastro($id);
        if (!$usuario)
            return redirect()->route('admin.home');

        return redirect()->route('admin.home');
    }
}
