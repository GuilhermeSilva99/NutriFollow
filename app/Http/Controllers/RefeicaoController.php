<?php

namespace App\Http\Controllers;
use App\Models\Refeicao;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RefeicaoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_refeicao' => 'required',
            'descricao_refeicao' => 'required',
            'caloria' => 'required',
            'horario' => 'required',
        ]);
        
        $dados = $request->all();
        $id = $dados['dieta_id'];
        Refeicao::create($dados);
        return redirect()->route('dieta.view-dieta', $id);
        
    }

    
    public function editarRefeicao($id){
        try {
            $refeicao = Refeicao::find($id);
            return view('refeicao.edit-refeicao',['refeicao' => $refeicao]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function atualizarRefeicao(Request $request, $id){
        try {
            $validated = $request->validate([
                'nome_refeicao' => 'required',
                'descricao_refeicao' => 'required',
                'caloria' => 'required',
                'horario' => 'required',
            ]);
            $dados = $request->all();
            $refeicao = Refeicao::find($id);
            $refeicao->nome_refeicao = $dados['nome_refeicao'];
            $refeicao->descricao_refeicao = $dados['descricao_refeicao'];
            $refeicao->caloria = $dados['caloria'];
            $refeicao->horario = $dados['horario'];
    
            $refeicao->save();
            return redirect()->back();

        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }
    
}
