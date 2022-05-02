<?php

namespace App\Http\Controllers;
use App\Models\Refeicao;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RefeicaoController extends Controller
{
    public function index()
    {
        //return("view");
        return view('refeicao.cadastro-refeicao');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_refeicao' => 'required',
            'descricao_refeicao' => 'required',
            'caloria' => 'required',
            'horario' => 'required',
        ]);
        $dados = $request->all();
        $dados['dieta_id'] = 1;
        Refeicao::create($dados);
        return redirect(route('refeicao.cadastroRefeicao'));
        
    }
    
}
