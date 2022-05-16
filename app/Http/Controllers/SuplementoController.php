<?php

namespace App\Http\Controllers;

use App\Models\Suplemento;
use Illuminate\Http\Request;

class SuplementoController extends Controller
{
    public function cadastrarsuplemento($id)
    {
        return view('suplemento.cadastro-suplemento-paciente', ["id" => $id]);
    }
    public function deletarSuplemento($id){
        $suplemento =Suplemento::find($id);
        $paciente_id = $suplemento->paciente_id;
        Suplemento::destroy($id);
        $suplementos = Suplemento::where('paciente_id', $paciente_id)->get();
        return view('suplemento.lista-suplementos-paciente', ['suplementos' => $suplementos, 'id' => $paciente_id]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'=> 'required',
            'quantidade'=> 'required',
            'data_inicio'=> 'required',
            'data_fim'=> 'required',
            'paciente_id' => 'required',
        ]);

        $dados = $request->all();
        Suplemento::create($dados);
        return redirect()->back();
    }

    public function editarSuplemento($id){
        try {
            $suplemento = Suplemento::find($id);
            return view('suplemento.edita-suplemento-paciente',['suplemento' => $suplemento, ]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function atualizarSuplemento(Request $request, $id){
        try {
            $validated = $request->validate([
                'nome'=> 'required',
                'quantidade'=> 'required',
                'data_inicio'=> 'required',
                'data_fim'=> 'required',
            ]);
            $dados = $request->all();
            $suplemento = Suplemento::find($id);
            $suplemento->nome = $dados['nome'];
            $suplemento->quantidade = $dados['quantidade'];
            $suplemento->data_inicio = $dados['data_inicio'];
            $suplemento->data_fim = $dados['data_fim'];
    
            $suplemento->save();
            $suplementos = Suplemento::where('paciente_id', $suplemento->paciente_id)->get();
            return view('suplemento.lista-suplementos-paciente', ['suplementos' => $suplementos, 'id' => $suplemento->paciente_id]);

        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function listarSuplementos(Request $request){
        $suplementos = Suplemento::where('paciente_id', $request->id)->get();
        return view('suplemento.lista-suplementos-paciente', ['suplementos' => $suplementos, 'id' => $request->id]);
    }
}