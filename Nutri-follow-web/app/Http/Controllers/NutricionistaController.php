<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
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

    public function storePaciente(StorePacienteRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $usuario = new User();
        $usuario->fill($data);
        $usuario->password = Hash::make($data['password']);
        $usuario->tipo_usuario = 3;
        $usuario->cadastro_aprovado = 1;
        $usuario->save();

        $paciente = new Paciente();
        $paciente->sexo = $data['sexo-select'] ?? $data['sexo-input'];
        $paciente->observacoes = $data['obs'];
        $paciente->user_id = $usuario->id;
        $paciente->nutricionista_id = Auth::user()->id;
        $paciente->save();

        // return redirect('/')->back()->with('success', 'Paciente cadastrado com sucesso!');
        return redirect('/');
    }

    public function list()
  {
    // $list_paciente  = Paciente::get(1);
    $list_paciente = DB::table('pacientes')->where('nutricionista_id', Auth::user()->id)->get();

    $list_user = array();
    foreach($list_paciente as $paciente):
      $list_user[] = User::find($paciente->user_id);
    endforeach;
    return view('paciente.list-paciente', ['list_paciente' => $list_paciente, 'list_user'=>$list_user]);
  }
}
