<?php

namespace Tests\Unit;

use App\Models\Nutricionista;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\Admin\AdminController;


class AdminTest extends TestCase
{
    /** @test */
    public function testVerificarAdminDesativaNutricionista()
    {
        $nutricionista = Nutricionista::factory(1)->create()->first();
        $nutricionista->user->cadastro_aprovado = true;
        $nutricionista->save();

        $admin = new AdminController();
        $admin->inativar($nutricionista->user->id);

        $user = User::onlyTrashed()->where('id', $nutricionista->user->id)->first();

        $this->assertEquals(0, $user->cadastro_aprovado);
    }
}
