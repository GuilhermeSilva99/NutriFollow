<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NutricionistaService;
use App\Models\Nutricionista;
use App\Models\Dieta;
use App\Models\Refeicao;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;

class DietaController extends Controller
{

    public function index()
    {
        try {
            $user_id = auth()->user()->id;
            $nutricionista = Nutricionista::where('user_id', Auth::user()->id)->first();
            $pacientes = Paciente::with("user")->where('nutricionista_id', $nutricionista->id)->get();
            return view('dieta.cadastro-dieta', ['pacientes' => $pacientes]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
        
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'paciente_id' => 'required'
        ]);
        $dados = $request->all();
        $dieta = Dieta::create($dados);
        $refeicoes = Dieta::where('dieta_id', $dieta->id);

        return redirect(route('dieta.view-dieta', ['id' => $dieta->id]));
        
    }
    public function view($id)
    {
        try {
            $dieta = Dieta::find($id);
            $dieta_id = $dieta->id;
            $refeicoes = Refeicao::where('dieta_id', $dieta->id)->get();
            return view('dieta.view-dieta', ['refeicoes' => $refeicoes, 'dieta_id' => $dieta->id]);
        } catch (\Illuminate\Database\QueryException $th) {
            echo "Erro de conexão com o Banco de Dados";
        }
    }

    public function adicionarRefeicao(Request $request, $id)
    {
        return view('refeicao.cadastro-refeicao', ['dieta_id' => $id]);
    }

    public function listarDietas($id){
        $dietas = Dieta::where("paciente_id", $id)->orderBy('id', 'DESC')->get();
        return view('dieta.list-dietas',['dietas' => $dietas]);
    }

}
