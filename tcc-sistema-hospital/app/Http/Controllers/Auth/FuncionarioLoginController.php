<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class FuncionarioLoginController extends Controller
{
    // Mostrar formulário de login do funcionário
    public function showLoginForm()
    {
        return view('login-funcionario');
    }

    // Fazer login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('funcionario')->attempt($credentials)) {
            $request->session()->regenerate(); // segurança
            return redirect()->route('dashboard.funcionario');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->withInput($request->only('email'));
    }

    // Fazer logout
    public function logout(Request $request)
    {
        Auth::guard('funcionario')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.funcionario');
    }

    // Dashboard do funcionário
    public function dashboard()
    {
        $pacientes = Paciente::all();
        return view('dashboard_funcionario', compact('pacientes'));
    }
}