<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Psicologo;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function create()
    {
        $psicologos = Psicologo::all(); // Obtém todos os psicólogos

        return Inertia::render('AgendarConsulta', [
            'psicologos' => $psicologos,
        ]);
    }

    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'psicologo_id' => 'required|exists:psicologos,id',
            'data' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i',
            'informacao'=> 'required|date_format:H:i',
        ]);

        // Verificar se o psicólogo está disponível nesse horário
        $horarioInicio = \Carbon\Carbon::createFromFormat('H:i', $request->horario_inicio);
        $horarioFim = \Carbon\Carbon::createFromFormat('H:i', $request->horario_fim);

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
            'paciente_id' => auth()->user()->paciente_id,// Utiliza o ID do paciente logado
            'psicologo_id' => $request->psicologo_id,
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
                            ->with('psicologo') // Carrega o relacionamento psicologo
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

    public function infoall()
    {
        $consultas = Consulta::with ('paciente')-> with('psicologo')->get();
        return Inertia::render('Informacao', [
            'consultas' => $consultas,
        ]);
    }
}
