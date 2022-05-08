<?php

namespace Tests\Feature;

use App\Repository\UserRepository;
use Tests\TestCase;

class PacienteViewTest extends TestCase
{

    public function test_view_user()
    {
        /* No banco de teste são criados por padrão via seed 3 usuários:
        1- admin
        2- Nutricionista já aprovado
        3- Paciente pertesente ao Nutricionista 2

        Os Ids são 1,2,3 respectivamente. 
        */
        $userRepository = new UserRepository();
        $usuarioNutricionista = $userRepository->find(2);
        $response = $this->actingAs($usuarioNutricionista)->get('/nutricionista/exibir/paciente/' . 3);
        $this->assertEquals(200, $response->status());
    }
}
