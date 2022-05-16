<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repository\MedidaRepository;
use App\Models\Paciente;
use App\Models\Medida;
use Carbon\Carbon;
use function PHPUnit\Framework\{assertEquals, assertNull, assertNotNull};

class MedidaTest extends TestCase
{
    public function test_cadastrar_medida_valida()
    {
        $dados = [
            "altura" => 1.5, 
            "peso" => 50.500, 
            "cintura" => 0.70, 
            "biceps" => 0.38, 
            "ombro" => 1.20, 
            "triceps" => 0.34, 
            "peito" => 0.80, 
            "coxa" => 0.70, 
            "panturrilha" => 0.40, 
            "quadril" => .90, 
            "data" => Carbon::now()
        ];

        $medida_repository = new MedidaRepository();
        $paciente = Paciente::all()->first();

        if($paciente == null)
            $paciente = Paciente::factory(1)->create();

        $dados["paciente_id"] = $paciente->id;
        $medida = $medida_repository->save($dados);

        assertEquals($medida->paciente_id, $paciente->id);
    }


    public function test_editar_medida_com_dados_validos()
    {
        $medida_repository = new MedidaRepository();
        $medida = Medida::factory(1)->create()->first();
        $peso_novo = 30;
        $medida_repository->update($medida->id, ['peso' => $peso_novo]);
        $medida_atualizada =  $medida_repository->find($medida->id);

        assertEquals($medida_atualizada->peso, $peso_novo);
        assertEquals($medida_atualizada->altura, $medida->altura);

    }


    public function test_excluir_medida_cadastrada()
    {
        $medida_repository = new MedidaRepository();
        $medida = Medida::factory(1)->create()->first();

        assertNotNull(Medida::find($medida->id));

        $medida_repository->deleteById($medida->id);

        assertNull(Medida::find($medida->id));
    }
}
