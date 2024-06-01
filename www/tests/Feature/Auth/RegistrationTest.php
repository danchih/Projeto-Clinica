<?php
namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'nome' => 'Test User',
            'username' => 'username',
            'password' => 'password',
        ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'username' => 'username',
    ]);

    $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
