<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

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
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            // Verificar se existe um cliente com o mesmo email
            $paciente = Paciente::where('email', $request->email)->first();

            if (!$paciente) {
                Log::error('Paciente não encontrado com este e-mail: ' . $request->email);
                return redirect()->back()->withErrors(['email' => 'Paciente não encontrado com este e-mail.']);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'paciente_id' => $paciente->id,
            ]);

            event(new Registered($user));

            Auth::login($user);

            Log::info('Usuário registrado com sucesso: ' . $user->email);

            return redirect()->route('homecliente');
        } catch (\Exception $e) {
            Log::error('Erro durante o registro do usuário: ' . $e->getMessage());
            throw $e; // Você pode manipular o erro de outra forma, se preferir.
        }
    }
}
