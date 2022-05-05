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

    public function listarNutricionistas()
    {
        $nutricionistas = $this->adminService->listarNutricionistas();
        return view('admin.lista-nutricionistas', ['nutricionistas' => $nutricionistas]);
    }

    public function inativarNutricionista($id)
    {
        $this->adminService->inativarNutricionista($id);
        return redirect()->route('admin.listar.nutricionistas');
    }

    public function listarNutricionistasInativos()
    {
        $users = $this->adminService->listarNutricionistasInativos();
        return view('admin.lista-nutricionistas-inativos', ['users' => $users]);
    }

    public function reativarNutricionista($id)
    {
        $this->adminService->reativarNutricionista($id);
        return redirect()->Route('admin.listar.nutricionistas.inativos');
    }

    public function ativarCadastroNutricionista($id)
    {
        $this->adminService->ativarCadastroNutricionista($id);
        return redirect()->route('admin.home');
    }

    public function recusarCadastroNutricionista($id)
    {
        $usuario = $this->adminService->recusarCadastroNutricionista($id);
        if (!$usuario)
            return redirect()->route('admin.home');

        return redirect()->route('admin.home');
    }
}
