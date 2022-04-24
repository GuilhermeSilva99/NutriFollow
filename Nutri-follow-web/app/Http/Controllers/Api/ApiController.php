<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function criarToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = User::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json(["erro" => "Credências invalidas"], 400);
        }

        if($usuario->tipo_usuario != 3){
            return response()->json(["erro" => "Apenas paciente pode gerar token"], 400);
        }

        return ["token" => $usuario->createToken(rand())->plainTextToken];
    }
}
