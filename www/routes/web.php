<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\NotificacaoController;


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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::get('/cadastro', function () {
    return Inertia::render('Cadastro');
})->name('cadastro');

Route::get('/psicologo', function () {
    return Inertia::render('Psicologo');
})->name('psicologo');

Route::get('/listapaciente', function () {
    return Inertia::render('Listapaciente');
})->name('listapaciente');

//Route::resource('pacientes', PacienteController::class);

/*Route::get('pacientes', [PacienteController::class, 'create'])
                ->name('pacientes');
Route::post('/pacientes', [PacienteController::class, 'store']);*/

Route::get('pacientes', [PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');

Route::post('/paciente-chegou', [PacienteController::class, 'pacienteChegou']);
Route::get('/verificar-notificacoes', [NotificacaoController::class, 'verificarNotificacoes']);

Route::post('/marcar-notificacao-como-lida', [NotificacaoController::class, 'marcarComoLida']);






require __DIR__.'/auth.php';



