<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePacienteRequest;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PacienteController extends Controller
{

    public function index()
    {
        return view('paciente.create-paciente');
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
      $list_paciente = DB::table('pacientes')->where('nutricionista_id', Auth::user()->id)->get();
  
      $list_user = array();
      foreach($list_paciente as $paciente):
        $list_user[] = User::find($paciente->user_id);
      endforeach;
      return view('paciente.list-paciente', ['list_paciente' => $list_paciente, 'list_user'=>$list_user]);
    }

    public function view($id)
  {
    $user[] =  User::find($id);
    $paciente = DB::table('pacientes')->where('user_id', $id)->get();
    return view('paciente.view-paciente', ['user' => $user[0], 'paciente' => $paciente[0]]);

  }

  public function getEditar($id)
  {
    $user[] =  User::find($id);
    $paciente = DB::table('pacientes')->where('user_id', $id)->get();
    return view('paciente.edit-paciente', ['user' => $user[0], 'paciente' => $paciente[0]]);

  }

  public function editar(UpdatePacienteRequest $r)
  {
    $data = $r->validated();
      try{
        $user =  User::find($r->id);
        $user->nome = $data['nome'];
        $user->email = $data['email'];
        $user->cpf = $data['cpf'];
        $user->telefone_1 = $data['telefone_1'];
        $user->telefone_2 = $data['telefone_2'];
        $user->update(); 

        $paciente = DB::table('pacientes')->where('user_id', $user->id)->first();
        $paciente = Paciente::find($paciente->id);
        $paciente->sexo = $data['sexo-select'] ?? $data['sexo-input'];
        $paciente->observacoes = $data['obs'];
        $paciente->update();

        return redirect('/list/paciente');
      }
    catch (\Illuminate\Database\QueryException $th) {
      //Está aqui por redundância, mas já está sendo tratada na validação.
      echo "Email ou matricula já existe no sistema.";
    }
  }

}
