<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Paciente;

class AuthController extends Controller
{
    public function showLoginPaciente()
    {
        return view('login-paciente');
    }

    public function loginPaciente(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ]);

        $paciente = Paciente::where('cpf', $request->cpf)->first();

        if ($paciente && Hash::check($request->password, $paciente->password)) {
            Auth::guard('paciente')->login($paciente);

            // 🔹 REDIRECT DIRETO PARA URL para evitar erro de rota
            return redirect('/dashboard-paciente')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['cpf' => 'CPF ou senha inválidos'])
                     ->withInput($request->only('cpf'));
    }

    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Você saiu com sucesso!');
    }

    public function dashboardPaciente()
    {
        $paciente = Auth::guard('paciente')->user();
        $preTriagem = $paciente->preTriagem;

        return view('dashboard_paciente', compact('paciente', 'preTriagem'));
    }
}