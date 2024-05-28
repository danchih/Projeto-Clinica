<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen()
    {
        // Crie um usuário com uma senha válida
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'password', // Use a mesma senha que foi definida no usuário
        ]);

        $this->assertAuthenticated(); // Verifica se o usuário está autenticado
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        // Crie um usuário com uma senha válida
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        // Tente autenticar com uma senha inválida
        $this->post('/login', [
            'username' => $user->username,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest(); // Verifica se o usuário não está autenticado
    }
}
