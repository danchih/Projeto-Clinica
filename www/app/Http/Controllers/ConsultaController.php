<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\User;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function create()
    {    
        $users = User::role('psicologo')->get(); // retorna todos os user que tem role 'psicologo'
        
        return Inertia::render('AgendarConsulta', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        // Validar os dados do formulário
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'data' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i',
            'informacao' => 'nullable|date_format:H:i',
        ]);

        // Verificar se o psicólogo está disponível nesse horário
        $horarioInicio = \Carbon\Carbon::createFromFormat('H:i', $request->horario_inicio);
        $horarioFim = \Carbon\Carbon::createFromFormat('H:i', $request->horario_fim);

        $consultaExistente = Consulta::where('user_id', $request->user_id)
                                    ->where('data', $request->data)
                                    ->where(function ($query) use ($horarioInicio, $horarioFim) {
                                        $query->where(function ($q) use ($horarioInicio, $horarioFim) {
                                            $q->where('horario_inicio', '<=', $horarioInicio)
                                              ->where('horario_fim', '>', $horarioInicio);
                                        })
                                        ->orWhere(function ($q) use ($horarioInicio, $horarioFim) {
                                            $q->where('horario_inicio', '<', $horarioFim)
                                              ->where('horario_fim', '>=', $horarioFim);
                                        });
                                    })
                                    ->exists();

        if ($consultaExistente) {
            return redirect()->back()->withInput()->with('error', 'Psicólogo já está ocupado nesse horário.');
        }

        // Criar uma nova consulta
        Consulta::create([
            'paciente_id' => auth()->user()->paciente_id,// Utiliza o ID do paciente logado
            'user_id' => $request->user_id,
            'data' => $request->data,
            'horario_inicio' => $request->horario_inicio,
            'horario_fim' => $request->horario_fim,
            'informacao'=>null,
        ]);

        // Redirecionar após a criação da consulta
        return redirect()->route('consultas.create')->with('success', 'Consulta agendada com sucesso!');
    }

    public function historico()
    {
        // Data e hora atual
        $now = now();

        // Obtém as consultas do paciente logado, com os dados completos do psicólogo
        $consultas = Consulta::where('paciente_id', auth()->user()->paciente_id)
                            ->with('user') // Carrega o relacionamento psicologo
                            ->where('data', '<', $now->toDateString()) // Consultas anteriores ao dia de hoje
                            ->orWhere(function ($query) use ($now) {
                                $query->where('data', '=', $now->toDateString())
                                    ->where('horario_inicio', '<=', $now->toTimeString());
                            })
                            ->orderBy('data', 'asc')
                            ->orderBy('horario_inicio', 'asc')
                            ->get();

        return Inertia::render('HistoricoConsultas', [
            'consultas' => $consultas,
        ]);
    }

    public function index()
    {
        $consultas = Consulta::where('user_id', auth()->user()->id)
                            ->with('paciente') // Carrega o relacionamento paciente
                            ->get();
        return response()->json($consultas);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'informacao' => 'nullable|string',
        ]);

        $consulta = Consulta::findOrFail($id);
        $consulta->informacao = $validated['informacao'];
        $consulta->save();

        return response()->json(['message' => 'Informação atualizada com sucesso']);
    }
}
