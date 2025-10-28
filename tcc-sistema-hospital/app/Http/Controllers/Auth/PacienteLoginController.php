<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class PacienteLoginController extends Controller
{
    /**
     * Exibe o formulário de login do paciente.
     */
    public function showLoginForm()
    {
        return view('login-paciente'); // resources/views/login-paciente.blade.php
    }

    /**
     * Realiza o login do paciente.
     */
    public function login(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('cpf', 'password');

        // Tenta autenticar o paciente
        if (Auth::guard('paciente')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.paciente');
        }

        // Caso falhe, retorna erro
        return back()
            ->withErrors(['cpf' => 'CPF ou senha incorretos.'])
            ->withInput();
    }

    /**
     * Exibe o dashboard do paciente logado.
     */
    public function dashboard()
    {
        $paciente = Auth::guard('paciente')->user();

        // Se não estiver logado, redireciona para login
        if (!$paciente) {
            return redirect()
                ->route('paciente.login')
                ->with('error', 'Sessão expirada. Faça login novamente.');
        }

        // View com underline (igual ao nome do seu arquivo)
        return view('dashboard_paciente', compact('paciente'));
    }

    /**
     * Faz logout do paciente.
     */
    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('paciente.login')
            ->with('success', 'Logout realizado com sucesso!');
    }
}
