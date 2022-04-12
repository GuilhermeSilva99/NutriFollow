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
        $user = User::find($id);
        $user->cadastro_aprovado = false;
        $user->save();
        $user = User::find($id);
        User::destroy($id);
        $nutricionistas = Nutricionista::whereRelation('user', 'cadastro_aprovado', true)->get();
        return view('admin.lista-nutricionistas', ['nutricionistas' => $nutricionistas]);
    }
}
