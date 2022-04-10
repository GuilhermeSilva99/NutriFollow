<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Nutricionista, User};

class AdministrarNutricionistasController extends Controller
{
    public function index()
    {
        $nutricionistas = Nutricionista::whereRelation('user', 'cadastro_aprovado', true)->get();
        return view('admin.lista-nutricionistas', ['nutricionistas' => $nutricionistas]);
    }

    public function inativar($id)
    {
        User::destroy($id);
        $nutricionistas = Nutricionista::whereRelation('user', 'cadastro_aprovado', true)->get();
        return view('admin.lista-nutricionistas', ['nutricionistas' => $nutricionistas]);
    }
}
