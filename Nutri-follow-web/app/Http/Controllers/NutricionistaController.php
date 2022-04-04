<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NutricionistaController extends Controller
{
    public function cadastroNaoConfirmado()
    {
        return view('nutricionista.cadastro-nao-confirmado');
    }
}
