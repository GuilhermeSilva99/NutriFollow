<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefeicaoController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nome_refeicao' => 'required',
            'descricao_refeicao' => 'required',
            'caloria' => 'required',
            'horario' => 'required',
        ]);

        $dados = $request->all();
        $id = $dados['dieta_id'];
        $dados = Auth::user()->nutricionista->id;
        Refeicao::create($dados);
        return redirect()->route('dieta.view-dieta', $id);
    }
}
