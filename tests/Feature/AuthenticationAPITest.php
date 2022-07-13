<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {

        $loginData = ['email' => 'nelsensepta@gmail.com', 'password' => 'septaAdmin'];

        $this->json('POST', 'api/v1/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200);

        $this->assertAuthenticated();
        // $this->assertAuthenticatedAs($user);
        // $this->assertAuthenticated($user);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "password_confirmation" => "demo12345",
        ];

        $this->json('POST', 'api/v1/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
                "message",
            ]);
    }
}