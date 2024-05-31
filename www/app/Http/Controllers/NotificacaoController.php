<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Notificacao;



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

    public function marcarComoLida(Request $request)
    {
        $notificacao = Notificacao::findOrFail($request->id);
        $notificacao->update(['lida' => true]);

        return response()->json(['message' => 'Notificação marcada como lida com sucesso']);
    }
}
