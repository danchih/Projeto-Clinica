<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Psicologo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConsultaController extends Controller
{
    public function create()
    {
        $psicologos = Psicologo::all();
        return inertia('AgendarConsulta', ['psicologos' => $psicologos]);
    }

    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'psicologo_id' => 'required|exists:psicologos,id',
            'data' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
        ]);

        // Calcular horário de fim
        $horarioInicio = Carbon::createFromFormat('H:i', $request->horario_inicio);
        $horarioFim = $horarioInicio->addMinutes(50)->format('H:i');

        // Obter o ID do paciente logado
        $pacienteId = Auth::id();

        // Verificar se o psicólogo está disponível nesse horário
        $consultaExistente = Consulta::where('psicologo_id', $request->psicologo_id)
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
            'paciente_id' => $pacienteId,
            'psicologo_id' => $request->psicologo_id,
            'data' => $request->data,
            'horario_inicio' => $request->horario_inicio,
            'horario_fim' => $horarioFim,
        ]);

        // Redirecionar após a criação da consulta
        return redirect()->route('homecliente')->with('success', 'Consulta agendada com sucesso!');
    }
}
