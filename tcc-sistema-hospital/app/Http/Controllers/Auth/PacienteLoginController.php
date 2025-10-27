<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class PacienteLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login-paciente'); // resources/views/login-paciente.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('cpf', 'password');

        if (Auth::guard('paciente')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.paciente');
        }

        return back()->withErrors(['cpf' => 'Credenciais inválidas.']);
    }

    public function dashboard()
    {
        $paciente = Auth::guard('paciente')->user();
        return view('dashboard_paciente', compact('paciente'));
    }

    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('paciente.login');
    }
}
