<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class PacienteController extends Controller
{
    public function index()
    {
        return view('paciente.create-paciente');
    }
}
