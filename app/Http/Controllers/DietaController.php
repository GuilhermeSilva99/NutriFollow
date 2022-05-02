<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DietaController extends Controller
{
    public function index()
    {
        //return("view");
        return view('dieta.cadastro-dieta');
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
        return redirect(route('dieta.cadastroDieta'));
        
    }
}
