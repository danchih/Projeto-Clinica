<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Inertia\Inertia;


class PacienteController extends Controller
{
    public function create()
    {
        return Inertia::render('Cadastro');
    }

    public function store(Request $request)
    {

        $mensagens = [
            'nome.required' => 'O nome é obrigatório.',
            'endereco.required' => 'O endereço é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.',
            'login.required' => 'O login é obrigatório.',
            'login.unique' => 'Este login já está em uso.',
            'senha.required' => 'A senha é obrigatória.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.'
        ];

        $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',
            'login' => 'required|string|max:255|unique:pacientes,login',
            'senha' => 'required|string|min:6',
        ], $mensagens);

        $paciente = Paciente::create([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
            'login' => $request->login,
            'senha' => bcrypt($request->senha), // Criptografar a senha
        ]);

        return response()->json(['message' => 'Paciente cadastrado com sucesso!']);
    }
}
