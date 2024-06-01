<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\User;
//use Illuminate\Foundation\Testing\DatabaseTransactions;

class PacienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testPacienteCreate()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->actingAs($user)->post('/pacientes', [
            'nome' => 'John Doe',
            'cep' => '12345678', 
            'endereco' => 'Rua Teste',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'TE',
            'telefone' => '1234567890',
            'username' => $user->username, // Username
            'password' => 'password', // Password
        ]);
    
        $response->assertStatus(302)
                 ->assertJson(['message' => 'Paciente cadastrado com sucesso!']);
    }
    

    public function testPacienteUpdate()
    {
        $user = User::factory()->create();
        $paciente = Paciente::factory()->create();

        $response = $this->actingAs($user)->put('/pacientes/' . $paciente->id, [
            'nome' => 'Jane Doe',
            'cep' => '87654321',
            'endereco' => 'Rua Alterada',
            'bairro' => 'Bairro Alterado',
            'cidade' => 'Cidade Alterada',
            'estado' => 'TA',
            'telefone' => '9876543210',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Paciente atualizado com sucesso!']);
    }
}
