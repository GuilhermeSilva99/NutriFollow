<?php

namespace Tests\Unit;

use App\Models\Nutricionista;
use App\Models\User;
use Tests\TestCase;
use App\Repository\NutricionistaRepository;
use App\Repository\UserRepository;
use App\Services\AdminService;
use Tests\MockNutricionista;

class AdminTest extends TestCase
{
    /** @test */
    public function testVerificarAdminDesativaNutricionista()
    {
        $nutricionistaRepository = new NutricionistaRepository();
        $userRepository = new UserRepository();
        $adminService = new AdminService($userRepository, $nutricionistaRepository);

        $nutricionista = MockNutricionista::criarNutricionista();
        $nutricionista->user->cadastro_aprovado = true;
        $nutricionista->user->save();

        $adminService->inativarNutricionista($nutricionista->user->id);

        $user = User::onlyTrashed()->where('id', $nutricionista->user->id)->first();

        $this->assertEquals(0, $user->cadastro_aprovado);
    }
}
