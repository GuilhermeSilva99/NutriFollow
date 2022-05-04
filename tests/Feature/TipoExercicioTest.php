<?php

namespace Tests\Feature;

use App\Models\Exercicio;
use App\Models\TipoExercicio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TipoExercicioTest extends TestCase
{
    public function testPegarTipoExercicio()
    {
        $usuarioPaciente = User::find(3);
        $tipoExercicio = TipoExercicio::all()->last();

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get('/api/paciente/tipo-exercicio/' . $tipoExercicio->id);

        $response->assertStatus(200)->assertJsonStructure(["nome", "id"]);
    }

    public function testListarTipoExercicio()
    {
        $usuarioPaciente = User::find(3);

        Sanctum::actingAs($usuarioPaciente, ['*']);

        $response = $this->get("/api/paciente/tipo-exercicio/listar");

        $response->assertStatus(200);
    }
}
