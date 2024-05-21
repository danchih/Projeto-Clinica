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
                'cep.required' => 'O CEP é obrigatório.',
                'cep.size' => 'O CEP deve ter 8 caracteres.',
                'endereco.required' => 'O endereço é obrigatório.',
                'bairro.required' => 'O bairro é obrigatório.',
                'cidade.required' => 'A cidade é obrigatória.',
                'estado.required' => 'O estado é obrigatório.',
                'telefone.required' => 'O telefone é obrigatório.',
                'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.',
                'login.required' => 'O login é obrigatório.',
                'login.unique' => 'Este login já está em uso.',
                'senha.required' => 'A senha é obrigatória.',
                'senha.min' => 'A senha deve ter pelo menos 6 caracteres.'
        ];

        $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'telefone' => 'required|string|max:15',
            'login' => 'required|string|max:255|unique:pacientes,login',
            'senha' => 'required|string|min:6',
        ], $mensagens);

        $paciente = Paciente::create([
            'nome' => $request->nome,
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'telefone' => $request->telefone,
            'login' => $request->login,
            'senha' => bcrypt($request->senha), // Criptografar a senha
        ]);

        return response()->json(['message' => 'Paciente cadastrado com sucesso!']);
    }
    public function index()
    {
        return Paciente::all();
    }

    public function update(Request $request, $id)
    {
        $mensagens = [
            'nome.required' => 'O nome é obrigatório.',
            'cep.required' => 'O cep é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.'
        ];

        $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',

        ], $mensagens);

        $paciente = Paciente::findOrFail($id);
        $paciente->nome = $request->nome;
        $paciente->cep = $request->cep;
        $paciente->endereco = $request->endereco;
        $paciente->bairro = $request->bairro;
        $paciente->cidade = $request->cidade;
        $paciente->estado = $request->estado;
        $paciente->telefone = $request->telefone;
        $paciente->save();

        return response()->json(['message' => 'Paciente atualizado com sucesso!']);
    }

}