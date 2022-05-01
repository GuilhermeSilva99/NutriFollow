<?php

namespace Tests\Feature;

use App\Models\Sono;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SonoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCriarSono()
    {
        $usuarioPaciente = User::find(3);

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $dadosSono = ["data" => "2022/05/01", "duracao" => "14:20", "avaliacao" => "Bom"];
        $response = $this->postJson('/api/paciente/sono/criar', $dadosSono);

        $response->assertStatus(200)->assertJson(['sucesso' => true]);
    }

    public function testPegarSono()
    {
        $usuarioPaciente = User::find(3);
        $sono = Sono::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get('/api/paciente/sono/' . $sono->id);

        $response->assertStatus(200)->assertJsonStructure(["data", "duracao", "avaliacao", "paciente_id"]);
    }

    public function testAtualizarSono()
    {
        $usuarioPaciente = User::find(3);
        $sono = Sono::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $dadosSono = ["data" => "2022/08/02", "duracao" => "06:10", "avaliacao" => "Ruim"];
        $response = $this->postJson("/api/paciente/sono/" . $sono->id . "/atualizar", $dadosSono);

        $response->assertStatus(200)->assertJson(['sucesso' => "Sono atualizado com sucesso!"]);
    }

    public function testDeletarSono()
    {
        $usuarioPaciente = User::find(3);
        $sono = Sono::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get("/api/paciente/sono/" . $sono->id . "/deletar");

        $response->assertStatus(200)->assertJson(['sucesso' => "Sono deletado com sucesso!"]);
    }
}
