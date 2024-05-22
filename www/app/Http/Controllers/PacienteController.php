<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules;


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
            'username.required' => 'O username é obrigatório.',
            'username.unique' => 'Este username já está em uso.',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'A password deve ter pelo menos 6 caracteres.'
        ];

        $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'telefone' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:6',
        ], $mensagens);

        DB::beginTransaction();
        try {
            $paciente = Paciente::create([
                'nome' => $request->nome,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'telefone' => $request->telefone,
            ]);

            $user = User::create([
                'nome' => $request->nome,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'paciente_id' => $paciente->id,
            ]);

            $user->assignRole('cliente');

            event(new Registered($user));

            Auth::login($user);

            DB::commit();

            return response()->json(['message' => 'Paciente cadastrado com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar paciente.'], 500);
        }
    }
}
