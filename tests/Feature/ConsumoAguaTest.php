<?php

namespace Tests\Feature;

use App\Models\ConsumoAgua;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ConsumoAguaTest extends TestCase
{
    public function testCriarConsumoAgua()
    {
        $usuarioPaciente = User::find(3);

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $dadosSono = ["data" => "2022/05/01", "quantidade" => "09"];
        $response = $this->postJson('/api/paciente/consumo-agua/criar', $dadosSono);

        $response->assertStatus(200)->assertJson(['sucesso' => true]);
    }

    public function testPegarConsumoAgua()
    {
        $usuarioPaciente = User::find(3);
        $consumoAgua = ConsumoAgua::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get("/api/paciente/consumo-agua/" . $consumoAgua->id);

        $response->assertStatus(200)->assertJsonStructure(["data", "quantidade", "paciente_id"]);
    }

    public function testAtualizarConsumoAgua()
    {
        $usuarioPaciente = User::find(3);
        $consumoAgua = ConsumoAgua::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $dadosSono = ["data" => "2022/08/02", "quantidade" => "02"];
        $response = $this->postJson("/api/paciente/consumo-agua/" . $consumoAgua->id . "/atualizar", $dadosSono);

        $response->assertStatus(200)->assertJson(['sucesso' => "Consumo de água atualizado com sucesso!"]);
    }

    public function testDeletarConsumoAgua()
    {
        $usuarioPaciente = User::find(3);
        $consumoAgua = ConsumoAgua::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get("/api/paciente/consumo-agua/" . $consumoAgua->id . "/deletar");

        $response->assertStatus(200)->assertJson(['sucesso' => "Consumo de água deletado com sucesso!"]);
    }
}
