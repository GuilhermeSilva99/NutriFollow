<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use App\Services\GeradorCPF;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiTokenTest extends TestCase
{
    use WithFaker;
    
    public function testCriarTokenApi()
    {
        $email = $this->faker->unique()->safeEmail();
        
        User::create([
            'nome' =>  $this->faker->name(),
            'email' => $email,
            'cpf' => GeradorCPF::gerarCPF(true),
            'telefone_1' => '(82)97988-5544',
            'telefone_2' => '(82)97988-5544',
            'crn' => strval(rand(10000000, 99999999)),
            'uf' => 'PE',
            'password' => Hash::make("password"),
            'tipo_usuario' => 3,
        ]);

        $response = $this->postJson('/api/criar-token', ['email' => $email, 'password' => 'password']);

        $response->assertStatus(200)
            ->assertJson([
                'token' => true,
            ]);
    }
}
