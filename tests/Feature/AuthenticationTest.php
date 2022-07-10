<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
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

    public function testUsersCanAuthenticateUsingTheLoginScreen()
    {
        $response = $this->post('/login', [
            'email' => "nelsensepta@gmail.com",
            'password' => 'septaAdmin',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
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

    public function testNewUsersCanRegister()
    {
        $user = User::factory()->make();
        // dd($user->toArray());
        $response = $this->post("/register", $user->toArray());
        // $this->assertAuthenticated($guard = null);
        // $this->actingAs($user, null);
        // $response->assertRedirect(RouteServiceProvider::HOME);
    }
    public function testAuthMiddlewareIsWorking()
    {
        $response = $this->get('/home/articles');
        $response->assertRedirect('/login');

        $response = $this->get('/home/categories');
        $response->assertRedirect('/login');
    }

    public function testTaskCrudIsWorking()
    {
        $user = User::factory()->create();

        // $response = $this->actingAs($user)->get("/home/categories");
        // $response->assertOk();

        // $response = $this->actingAs($user)->get('/home/tasks/create');
        // $response->assertOk();

        // $response = $this->actingAs($user)->post('/home/tasks', ['name' => 'Test']);
        // $response->assertRedirect('home/tasks');

        // $task = Task::factory()->create();
        // $response = $this->actingAs($user)->put('/home/tasks/' . $task->id, ['name' => 'Test 2']);
        // $response->assertRedirect('home/tasks');

        // $this->assertDatabaseHas(Task::class, ['name' => 'Test 2']);
        // $response = $this->actingAs($user)->delete('/home/tasks/' . $task->id);
        // $response->assertRedirect('home/tasks');
        // $this->assertDatabaseMissing(Task::class, ['name' => 'Test 2']);
    }

}