<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class NotificacaoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testVerificaSeAsNotificacoesSaoRetornadasECacheLimpo()
    {
        // Adiciona notificações fictícias ao cache
        $notificacoes = [
            ['mensagem' => 'Notificação 1'],
            ['mensagem' => 'Notificação 2'],
        ];
        Cache::put('notificacoes', $notificacoes);

        // Chama o endpoint do controller para verificar notificações
        $response = $this->get('/verificar-notificacoes');

        // Verifica se o status da resposta é OK
        $response->assertStatus(200);

        // Verifica se as notificações retornadas são as mesmas do cache
        $response->assertJson($notificacoes);

        // Verifica se o cache foi limpo após a verificação
        $this->assertFalse(Cache::has('notificacoes'));
    }
}
