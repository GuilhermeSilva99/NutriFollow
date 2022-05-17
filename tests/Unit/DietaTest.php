<?php

namespace Tests\Unit;

use App\Models\Exame;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Dieta;
use App\Http\Controllers\DietaController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class DietaTest extends TestCase
{
    use WithFaker;



    public function testCadastrarDietaPaciente(){
        $paciente = Paciente::first();
        $dieta = new Dieta();
        $dietaController = new DietaController();
        
        $dados = [
            'descricao' => 'Dieta do paciente',  'data_inicio' => '2022-05-02',
            'data_fim' =>'2022-07-02', 'paciente_id'=>$paciente->id
        ];
        $request = new Request($dados);
        $dietaController->store($request);
        $ultimaDieta = $dieta->latest()->first();
        assertEquals($dados['data_inicio'], $ultimaDieta->data_inicio);
        assertEquals($dados['data_fim'], $ultimaDieta->data_fim);
        assertEquals($dados['paciente_id'], $ultimaDieta->paciente_id);
    }

    
    public function testEditarDietaPaciente(){
        $paciente = Paciente::first();
        $dieta = new Dieta();
        $dietaController = new DietaController();
        
        $dados = [
            'descricao' => 'Dieta do paciente',  'data_inicio' => '2022-05-02',
            'data_fim' =>'2022-07-02', 'paciente_id'=>$paciente->id
        ];
        $request = new Request($dados);
        $dietaController->store($request);
       
        $ultimaDieta = $dieta->latest()->first();

        $dados_edit = [
            'descricao' => 'descricao do paciente editada',  'data_inicio' => '2022-05-20',
            'data_fim' =>'2022-07-20'
        ];
        
        $request = new Request($dados_edit);

        $dietaController->atualizarDieta($request, $ultimaDieta->id);

        $dietaEditada = $dieta->find($ultimaDieta->id);
        
        assertEquals($dados_edit['descricao'], $dietaEditada->descricao);
        assertEquals($dados_edit['data_inicio'], $dietaEditada->data_inicio);
        assertEquals($dados_edit['data_fim'], $dietaEditada->data_fim);

    }
    
}
