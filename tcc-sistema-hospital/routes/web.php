<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PacienteRegisterController;
use App\Http\Controllers\Auth\FuncionarioLoginController;
use App\Http\Controllers\PreTriagemController;
use App\Http\Controllers\ResultadoPrioridadeController;

// Página inicial
Route::get('/', fn() => view('welcome'));

// Identificação
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

    // Dashboard paciente
    Route::get('/dashboard-paciente', [AuthController::class, 'dashboardPaciente'])->name('dashboard.paciente');

    // Logout paciente
    Route::post('/logout/paciente', [AuthController::class, 'logout'])->name('paciente.logout');

    // Formulário de pré-triagem
    Route::get('/formulario-pre-triagem', [PreTriagemController::class, 'index'])->name('formulario.pre-triagem');
    Route::post('/formulario-pre-triagem', [PreTriagemController::class, 'store'])->name('formulario.pre-triagem.store');

    // Página de resultado — agora o parâmetro é opcional, evita erros
    Route::get('/resultado-prioridade/{codigo?}', [ResultadoPrioridadeController::class, 'index'])
        ->name('resultado.prioridade');

    // Guia de primeiros socorros
    Route::get('/guia-primeiros-socorros', fn() => view('guia_primeiros_socorros'))->name('guia.primeiro-socorros');
});

// ==============================
// Login e dashboard funcionário
// ==============================
Route::get('/login/funcionario', [FuncionarioLoginController::class, 'showLoginForm'])->name('login.funcionario');
Route::post('/login/funcionario', [FuncionarioLoginController::class, 'login'])->name('login.funcionario.submit');

Route::middleware('auth:funcionario')->group(function () {
    Route::get('/dashboard/funcionario', [FuncionarioLoginController::class, 'dashboard'])->name('dashboard.funcionario');
    Route::post('/logout/funcionario', [FuncionarioLoginController::class, 'logout'])->name('funcionario.logout');
});
