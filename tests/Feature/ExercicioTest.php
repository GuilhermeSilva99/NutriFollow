<?php

namespace Tests\Feature;

use App\Models\Exercicio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExercicioTest extends TestCase
{
    public function testCriarExercicio()
    {
        $usuarioPaciente = User::find(3);

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $dadosExercicio = [
            "data" => "2022/05/01", "duracao" => "01:50", "tipo" => "api exercicio",
            "descricao" => "desc api", "tipo_exercicio_id" => 1
        ];
        $response = $this->postJson('/api/paciente/exercicio/criar', $dadosExercicio);

        $response->assertStatus(200)->assertJson(['sucesso' => true]);
    }

    public function testPegarExercicio()
    {
        $usuarioPaciente = User::find(3);
        $exercicio = Exercicio::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get('/api/paciente/exercicio/' . $exercicio->id);

        $response->assertStatus(200)->assertJsonStructure([
            "data", "duracao", "tipo", "paciente_id",
            "descricao", "tipo_exercicio_id"
        ]);
    }

    public function testAtualizarExercicio()
    {
        $usuarioPaciente = User::find(3);
        $exercicio = Exercicio::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $dadosExercicio = [
            "data" => "2022/08/02", "duracao" => "03:10", "tipo" => "api exercicio",
            "descricao" => "desc api", "tipo_exercicio_id" => 1
        ];
        $response = $this->putJson("/api/paciente/exercicio/" . $exercicio->id . "/atualizar", $dadosExercicio);

        $response->assertStatus(200)->assertJson(['sucesso' => "Exercício atualizado com sucesso!"]);
    }

    public function testDeletarExercicio()
    {
        $usuarioPaciente = User::find(3);
        $exercicio = Exercicio::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->delete("/api/paciente/exercicio/" . $exercicio->id . "/deletar");

        $response->assertStatus(200)->assertJson(['sucesso' => "Exercício deletado com sucesso!"]);
    }

    public function testListarExercicio()
    {
        $usuarioPaciente = User::find(3);

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get("/api/paciente/exercicio/listar");

        $response->assertStatus(200);
    }
}
