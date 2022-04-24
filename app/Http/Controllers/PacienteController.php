<?php

namespace App\Http\Controllers;


use App\Http\Requests\ResetPasswordRequest;
use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePacienteRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PacienteController extends Controller
{

    public function index()
    {
        return view('paciente.create-paciente');
    }

    
    public function storePaciente(StorePacienteRequest $request)
    {
      
      $data = $request->validated();
      try{
          $usuario = new User();
          $usuario->fill($data);
          $usuario->password = Hash::make($data['password']);
          $usuario->tipo_usuario = 3;
          $usuario->cadastro_aprovado = 1;
          $usuario->save();

          $nutricionista = DB::table('nutricionistas')->where('user_id', Auth::user()->id)->get();
          $paciente = new Paciente();
          $paciente->sexo = $data['sexo-select'] ?? $data['sexo-input'];
          $paciente->observacoes = $data['obs'];
          $paciente->user_id = $usuario->id;
          $paciente->nutricionista_id = $nutricionista[0]->id;
          $paciente->save();

          return redirect('/list/paciente');
      }
      catch (\Illuminate\Database\QueryException $th) {
        echo "Erro de conexão com o Banco de Dados";
      }
    }

    public function list()
    {
      try{
        $nutricionista = DB::table('nutricionistas')->where('user_id', Auth::user()->id)->get();
        $list_paciente = DB::table('pacientes')->where('nutricionista_id', $nutricionista[0]->id)->get();
    
        $list_user = array();
        foreach($list_paciente as $paciente):
          $list_user[] = User::find($paciente->user_id);
        endforeach;
        
        return view('paciente.list-paciente', ['list_paciente' => $list_paciente, 'list_user'=>$list_user]);
      }
        catch (\Illuminate\Database\QueryException $th) {
          echo "Erro de conexão com o Banco de Dados";
      }
    }

    public function view($id)
  {
    try{
      $user[] =  User::find($id);
      $paciente = DB::table('pacientes')->where('user_id', $id)->get();
      return view('paciente.view-paciente', ['user' => $user[0], 'paciente' => $paciente[0]]);
    }
    catch (\Illuminate\Database\QueryException $th) {
      echo "Erro de conexão com o Banco de Dados";
    }

  }

  public function getEditar($id)
  {
    try{
      $user[] =  User::find($id);
      $paciente = DB::table('pacientes')->where('user_id', $id)->get();
      return view('paciente.edit-paciente', ['user' => $user[0], 'paciente' => $paciente[0]]);
    }
    catch (\Illuminate\Database\QueryException $th) {
      echo "Erro de conexão com o Banco de Dados";
    }

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
      echo "Erro de conexão com o Banco de Dados";
    }
  }

  public function edit_password($id)
  {
    try{
      $user[] =  User::find($id);
      return view('paciente.edit-password', ['user' => $user[0]]);
    }
    catch (\Illuminate\Database\QueryException $th) {
      echo "Erro de conexão com o Banco de Dados";
    }
  }

  public function reset_password(ResetPasswordRequest $request)
  {
      try{
        $user =  User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->update();         

        return redirect('/list/paciente');
      }
    catch (\Illuminate\Database\QueryException $th) {
      echo "Erro de conexão com o Banco de Dados";
    }
  }

}
