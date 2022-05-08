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

    
    
}
