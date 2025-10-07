<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PacienteRegisterController;
use App\Http\Controllers\Auth\FuncionarioLoginController;
use App\Http\Controllers\PreTriagemController;
use App\Http\Controllers\ResultadoPrioridadeController;
use App\Http\Controllers\SalaController;

// ==============================
// Página inicial
// ==============================
Route::get('/', fn() => view('welcome'));

// ==============================
// Identificação
// ==============================
Route::get('/identificacao', fn() => view('identificacao'));

// ==============================
// Login e cadastro paciente
// ==============================
Route::get('/login/paciente', [AuthController::class, 'showLoginPaciente'])->name('paciente.login');
Route::post('/login/paciente', [AuthController::class, 'loginPaciente'])->name('paciente.login.submit');

Route::get('/register/paciente', [PacienteRegisterController::class, 'showRegistrationForm'])->name('paciente.register');
Route::post('/register/paciente', [PacienteRegisterController::class, 'register'])->name('paciente.register.submit');

// ==============================
// Rotas protegidas para paciente
// ==============================
Route::middleware('auth:paciente')->group(function () {
    Route::get('/dashboard-paciente', [AuthController::class, 'dashboardPaciente'])->name('dashboard.paciente');
    Route::post('/logout/paciente', [AuthController::class, 'logout'])->name('paciente.logout');

    Route::get('/formulario-pre-triagem', [PreTriagemController::class, 'index'])->name('formulario.pre-triagem');
    Route::post('/formulario-pre-triagem', [PreTriagemController::class, 'store'])->name('formulario.pre-triagem.store');

    Route::get('/resultado-prioridade/{codigo?}', [ResultadoPrioridadeController::class, 'index'])
        ->name('resultado.prioridade');

    Route::get('/guia-primeiros-socorros', fn() => view('guia_primeiros_socorros'))->name('guia.primeiro-socorros');
});

// ==============================
// Login e dashboard funcionário
// ==============================
Route::get('/login/funcionario', [FuncionarioLoginController::class, 'showLoginForm'])->name('login.funcionario');
Route::post('/login/funcionario', [FuncionarioLoginController::class, 'login'])->name('login.funcionario.submit');

Route::middleware('auth:funcionario')->group(function () {

    // Menu inicial do funcionário (primeira página após login)
    Route::get('/dashboard/funcionario', fn() => view('menu_funcionario'))->name('dashboard.funcionario');

    // Dashboard real de cards (pacientes)
    Route::get('/dashboard/funcionario/cards', [FuncionarioLoginController::class, 'dashboard'])
        ->name('dashboard.funcionario.cards');

    // Consultórios / Salas médicas
    Route::get('/dashboard/funcionario/consultorios', [SalaController::class, 'dashboard'])
        ->name('dashboard.consultorios');

    // Atualizar sala de paciente via AJAX
    Route::post('/salas/atualizar/{paciente}', [SalaController::class, 'atualizarSala'])
        ->name('salas.atualizar');

    // Logout funcionário
    Route::post('/logout/funcionario', [FuncionarioLoginController::class, 'logout'])
        ->name('funcionario.logout');
});
