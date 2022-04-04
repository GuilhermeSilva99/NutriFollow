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
    public function testApiToken()
    {
        $response = $this->postJson('/api/sanctum/token', ['email' => 'email@email.com', 'password' => 'password']);

        $response->assertStatus(200)
            ->assertJson([
                'token' => true,
            ]);
    }
}
