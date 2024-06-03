<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use App\Events\Registered;

class PacienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testPacienteCreate()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'username' => 'unique_username_' . uniqid(), // Gera um username único
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

    public function testPacienteStoreValidationFails()
    {
        $data = [
            'nome' => '',
            'cep' => '1234',
            'endereco' => '',
            'bairro' => '',
            'cidade' => '',
            'estado' => '',
            'telefone' => '',
            'username' => '',
            'password' => '',
        ];

        $response = $this->postJson('/pacientes', $data);

        $response->assertStatus(422); // 422 Unprocessable Entity for validation errors
    }
    
    public function testPacienteUpdate()
    {
        $user = User::factory()->create([
            'username' => 'unique_username_' . uniqid(), // Gera um username único
        ]);
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

    public function testNotificacaoEArmazenadaNoCacheELogadaCorretamente()
    {
        // Dados de entrada
        $pacienteId = 1;
        $pacienteNome = 'João';
        $psicologoId = 1;
        
        // Chamada ao método pacienteChegou
        $response = $this->post('/paciente-chegou', [
            'paciente_id' => $pacienteId,
            'paciente_nome' => $pacienteNome,
            'psicologo_id' => $psicologoId
        ]);
        
        // Verificações
        
        // Verifica se o status da resposta é OK
        $response->assertStatus(200);
        
        // Verifica se a notificação foi armazenada no cache
        $this->assertTrue(Cache::has('notificacoes'));
        
        // Verifica se a notificação contém o nome do paciente
        $notificacoes = Cache::get('notificacoes');
        $this->assertContains("O paciente $pacienteNome chegou", $notificacoes);
        
    }
    
    public function testRetornaErroQuandoDadosDePacienteIncompletos()
    {
        // Chamada ao método pacienteChegou com dados incompletos
        $response = $this->post('/paciente-chegou', [
            'paciente_id' => 1,
            // 'paciente_nome' => 'João', <- paciente_nome não fornecido
            'psicologo_id' => 1
        ]);
        
        // Verificações
        
        // Verifica se o status da resposta é 400 (Bad Request)
        $response->assertStatus(400);
        
        // Verifica se a mensagem de erro foi retornada corretamente
        $response->assertJson(['message' => 'Dados de paciente incompletos']);
        
        // Verifica se a notificação não foi armazenada no cache
        $this->assertFalse(Cache::has('notificacoes'));
        
    }
}
