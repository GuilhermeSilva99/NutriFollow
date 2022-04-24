<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class NutricionistaController extends Controller
{
    public function cadastroNaoConfirmado()
    {
        return view('nutricionista.cadastro-nao-confirmado');
    }

    public function cadastrarPacienteView()
    {
        return view('nutricionista.cadastro-paciente');
    }
}
