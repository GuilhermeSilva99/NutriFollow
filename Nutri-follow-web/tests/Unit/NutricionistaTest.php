<?php

namespace Tests\Unit;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Admin\HomeController;
use App\Models\Nutricionista;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\DatabaseTrclsansactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AprovacaoNutriTest extends TestCase
{
    /** @test */
    public function create_nutricionista_pendente()
    {
        $user = new CreateNewUser();
       
        $usuario = $user->create([
            'nome' => 'Fulano',
            'email' => 'fulano@gmail.com',
            'cpf' => '87685664097',
            'telefone1' => '(82)97988-5544',
            'telefone2' => '(82)97988-5544',
            'crn' => '25364897',
            'uf' => 'PE',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertEquals(0, $usuario->cadastro_aprovado);
        

        User::destroy($usuario->id);

    }

    /** @test */
    public function ativar_nutricionista_pendente()
    {
   
        $usuario = User::create([
            'nome' => 'Funano',
            'email' => 'fulano@gmail.com',
            'cpf' => '12365478900',
            'telefone_1' => '87988997744',
            'telefone_2' => '87988997744',
            'tipo_usuario' => 2,
            'password' => '12345678',
        ]);

       $nutricionista = Nutricionista::create([
            'crn' => '55669874',
            'uf' => 'PE',
            'user_id' => $usuario->id,
        ]);
        
        $admin = new HomeController();
        $admin->ativar_cadastro($usuario->id);

        $usuario = User::find($usuario->id);

        $this->assertEquals(1,  $usuario->cadastro_aprovado);
        

        User::destroy($usuario->id);

    }

    /** @test */
    public function reprovar_nutricionista_pendente()
    {
   
        $usuario = User::create([
            'nome' => 'Funano',
            'email' => 'fulano@gmail.com',
            'cpf' => '12365478900',
            'telefone_1' => '87988997744',
            'telefone_2' => '87988997744',
            'tipo_usuario' => 2,
            'password' => '12345678',
        ]);

       $nutricionista = Nutricionista::create([
            'crn' => '55669874',
            'uf' => 'PE',
            'user_id' => $usuario->id,
        ]);
        
        $admin = new HomeController();
        $admin->recusar_cadastro($usuario->id);

        $usuario = User::find($usuario->id);

        $this->assertEquals(null,  $usuario);
        

    }


}