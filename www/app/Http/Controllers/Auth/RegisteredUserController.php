<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $mensagens = [
                'nome.required' => 'O nome é obrigatório.',
                'username.required' => 'O username é obrigatório.',
                'username.unique' => 'Este username já está em uso.',
                'password.required' => 'A password é obrigatória.',
                'password.min' => 'A password deve ter pelo menos 6 caracteres.'
            ];

            $request->validate([
                'nome' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|min:6',
            ], $mensagens);

            $user = User::create([
                'nome' => $request->nome,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'paciente_id' => NULL,
            ]);

            switch ($request->role) {
                case '1':
                    $user->assignRole('secretaria');
                    break;
                case '2':
                    $user->assignRole('psicologo');
                    break;
            }     
            
            event(new Registered($user));

            //Auth::login($user);

            return redirect(RouteServiceProvider::HOME)->with('success', 'Usuário cadastrado com sucesso!');;
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Erro ao registrar o usuario: ' . $e->getMessage()]);
        }
    
    }
}
