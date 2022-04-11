<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePacienteRequest;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paciente.register-paciente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $input)
    {
        dd($input['']);
        // Validator::make($input, [
        //     'nome' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'cpf' => ['required', 'string', 'cpf', 'unique:users'],
        //     'telefone1' => ['required', 'string', 'celular_com_ddd'],
        //     'telefone2' => ['required', 'string', 'celular_com_ddd'],
        //     // 'password' => PasswordValidationRules(),
        //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        // ])->validate();

        // $usuario = User::create([
        //     'nome' => $input['nome'],
        //     'email' => $input['email'],
        //     'cpf' => $input['cpf'],
        //     'telefone_1' => $input['telefone1'],
        //     'telefone_2' => $input['telefone2'],
        //     'tipo_usuario' => 3,
        //     'cadastro_aprovado' => 1,
        //     'password' => Hash::make($input['password']),
        // ]);

        // Paciente::create([
        //     'sexo' => $input['sexo'],
        //     'observacao' => $input['observacao'],
        //     'user_id' => $usuario->id,
        //     'nutricionista_id' => Auth::User()->id,
        // ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePacienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePacienteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePacienteRequest  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
