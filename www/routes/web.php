<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PacienteController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/login', function () {
    return Inertia::render('Navbar', [
        'canLogin' => Route::has('login')
    ]);
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/homecliente', function () {
        return Inertia::render('HomeCliente');
    })->name('homecliente');
});

//Consultas
Route::get('/agendar-consulta', [ConsultaController::class, 'create'])->name('consultas.create');
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
Route::get('/historico', [ConsultaController::class, 'historico'])->name('consultas.historico');

Route::get('/cadastro', function () {
    return Inertia::render('Cadastro');
})->name('cadastro');

Route::get('/psicologa', function () {
    return Inertia::render('Psicologa');
})->name('psicologa');

Route::get('/listapaciente', function () {
    return Inertia::render('Listapaciente');
})->name('listapaciente');

Route::get('/documentos', function () {
    return Inertia::render('Documentospaciente');
})->name('documentos');

Route::get('/pacientes', [PacienteController::class, 'index']);
Route::post('/pacientes', [PacienteController::class, 'store']);
Route::put('/pacientes/{id}', [PacienteController::class, 'update']); // Rota de atualização

Route::get('pacientes', [PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');


Route::get('/pacientes', [PacienteController::class, 'index']);

require __DIR__.'/auth.php';
