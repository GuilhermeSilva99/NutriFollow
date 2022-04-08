<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTokenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCriarTokenApi()
    {
        $response = $this->postJson('/api/criar-token', ['email' => 'email@email.com', 'password' => 'password']);

        $response->assertStatus(200)
            ->assertJson([
                'token' => true,
            ]);
    }
}
