<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rota para Login
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Rota para o Home do User
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'canRegister' => Route::has('register'),    
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

//Rota para vue Cadastro de Paciente
Route::get('/cadastro', function () {
    return Inertia::render('Cadastro');
})->name('cadastro');

//Rota para vue Lista de Paciente
Route::get('/listapaciente', function () {
    return Inertia::render('Listapaciente');
})->name('listapaciente');

//Rota para vue Documento
Route::get('/documentos', function () {
    return Inertia::render('Documentospaciente');
})->name('documentos');

//Rota para Registro de Secretaria e Psicologo
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

//Rota para Criar Paciente
Route::get('pacientes', [PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');

//Rota para Consultas
Route::get('/agendar-consulta', [ConsultaController::class, 'create'])->name('consultas.create');
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
Route::get('/historico-consultas', [ConsultaController::class, 'historico'])->name('consultas.historico');
Route::get('/consultas-futuras', [ConsultaController::class, 'consultar'])->name('consultas.futuras');

//Rota para Editar info do Paciente
Route::get('/pacientes', [PacienteController::class, 'index']);
Route::post('/pacientes', [PacienteController::class, 'store']);
Route::put('/pacientes/{id}', [PacienteController::class, 'update']); // Rota de atualização

//Rota do MailTrap
Route::post('/send-email', [ContactController::class, 'sendEmail']);

Route::get('/info', function () {
    return Inertia::render('InfoConsulta');
})->name('info');

Route::get('/consultas', [ConsultaController::class, 'index']);


