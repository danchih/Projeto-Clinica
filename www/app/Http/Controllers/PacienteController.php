<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;

class PacienteController extends Controller
{
    public function index()
    {
        // Lógica para listar todos os clientes
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    public function store(Request $request)
    {
        // Validar os dados do cliente e do usuário
        $validatedData = $request->validate([
            'paciente.nome' => 'required|string|max:255',
            'paciente.email' => 'required|string|email|max:255|unique:pacientes,email',
            'paciente.cep' => 'required|integer',
            'paciente.endereco' => 'required|string|max:255',
            'paciente.bairro' => 'required|string|max:255',
            'paciente.cidade' => 'required|string|max:255',
            'paciente.estado' => 'required|string|max:255',
            'paciente.telefone' => 'required|string|max:20',
        ]);

        // Criar o cliente
        $paciente = Paciente::create($validatedData['paciente']);

        return response()->json(['paciente' => $paciente], 201);
    }

    public function show($id)
    {
        // Lógica para mostrar os detalhes de um cliente específico
        $paciente = Paciente::findOrFail($id);
        return response()->json($paciente);
    }

    public function update(Request $request, $id)
    {
        // Lógica para atualizar os detalhes de um cliente
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());
        return response()->json($paciente, 200);
    }

    public function destroy($id)
    {
        // Lógica para excluir um cliente
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();
        return response()->json(null, 204);
    }
}