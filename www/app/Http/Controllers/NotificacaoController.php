<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class NotificacaoController extends Controller
{
    public function verificarNotificacoes()
    {
        // Verifique se há alguma notificação no cache
        $notificacoes = Cache::get('notificacoes', []);
        
        // Limpe as notificações após lê-las
        Cache::forget('notificacoes');

        return response()->json($notificacoes);
    }

}
