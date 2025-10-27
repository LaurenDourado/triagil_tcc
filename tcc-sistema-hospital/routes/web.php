<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PacienteLoginController;
use App\Http\Controllers\Auth\PacienteRegisterController;
use App\Http\Controllers\Auth\FuncionarioLoginController;
use App\Http\Controllers\PreTriagemController;
use App\Http\Controllers\ResultadoPrioridadeController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\PacienteController;

// ==============================
// Página inicial
// ==============================
Route::get('/', fn() => view('welcome'));

// ==============================
// Identificação
// ==============================
Route::get('/identificacao', fn() => view('identificacao'));

// ==============================
// Login e cadastro PACIENTE
// ==============================
Route::get('/login/paciente', [PacienteLoginController::class, 'showLoginForm'])->name('paciente.login');
Route::post('/login/paciente', [PacienteLoginController::class, 'login'])->name('paciente.login.submit');

Route::get('/register/paciente', [PacienteRegisterController::class, 'showRegistrationForm'])->name('paciente.register');
Route::post('/register/paciente', [PacienteRegisterController::class, 'register'])->name('paciente.register.submit');

// ==============================
// Rotas protegidas para PACIENTE
// ==============================
Route::middleware('auth:paciente')->group(function () {

    // Dashboard do paciente
    Route::get('/dashboard-paciente', [PacienteLoginController::class, 'dashboard'])->name('dashboard.paciente');

    // Logout
    Route::post('/logout/paciente', [PacienteLoginController::class, 'logout'])->name('paciente.logout');

    // Formulário de pré-triagem
    Route::get('/formulario-pre-triagem', [PreTriagemController::class, 'index'])->name('formulario.pre-triagem');
    Route::post('/formulario-pre-triagem', [PreTriagemController::class, 'store'])->name('formulario.pre-triagem.store');

    // Resultado de prioridade
    Route::get('/resultado-prioridade/{codigo?}', [ResultadoPrioridadeController::class, 'index'])
        ->name('resultado.prioridade');

    // Guia de primeiros socorros
    Route::get('/guia-primeiros-socorros', fn() => view('guia_primeiros_socorros'))
        ->name('guia.primeiro-socorros');

    // CRUD do paciente
    Route::get('/paciente/crud', [PacienteController::class, 'crud'])->name('paciente.crud');
    Route::post('/paciente/store', [PacienteController::class, 'store'])->name('paciente.store');

    Route::get('/paciente/edit/{id}', [PacienteController::class, 'edit'])->name('paciente.edit');
    Route::post('/paciente/update/{id}', [PacienteController::class, 'update'])->name('paciente.update');
    Route::delete('/paciente/destroy/{id}', [PacienteController::class, 'destroy'])->name('paciente.destroy');
});

// ==============================
// Login e dashboard FUNCIONÁRIO
// ==============================
Route::get('/login/funcionario', [FuncionarioLoginController::class, 'showLoginForm'])->name('login.funcionario');
Route::post('/login/funcionario', [FuncionarioLoginController::class, 'login'])->name('login.funcionario.submit');

Route::middleware('auth:funcionario')->group(function () {

    // Dashboard do funcionário
    Route::get('/dashboard/funcionario', fn() => view('menu_funcionario'))->name('dashboard.funcionario');

    // Dashboard de cards (pacientes)
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
