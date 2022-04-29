<?php

namespace App\Http\Controllers;


use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Services\PacienteService;

class PacienteController extends Controller
{

    public function index()
    {
        return view('paciente.create-paciente');
    }
}
