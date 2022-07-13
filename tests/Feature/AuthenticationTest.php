<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use DatabaseTransactions;
    use RefreshDatabase;

    public function testLoginScreenCanBeRendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testUsersCanNotAuthenticateWithInvalidPassword()
    {

        $this->post('/login', [
            'email' => "nelsensepta@gmail.com",
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function testRegistrationScreenCanBeRendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

}