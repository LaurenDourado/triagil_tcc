<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Paciente;

class PacienteRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register-paciente'); // resources/views/register-paciente.blade.php
    }

    public function register(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|unique:pacientes,cpf',
            'email' => 'required|string|email|max:255|unique:pacientes,email',
            'telefone' => 'required|string|max:20',
            'idade' => 'required|integer|min:0',
            'genero' => 'required|in:feminino,masculino,outro',
            'password' => 'required|confirmed|min:6',
        ]);

        // Criação do paciente
        $paciente = Paciente::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'idade' => $request->idade,
            'genero' => $request->genero,
            'password' => Hash::make($request->password),
        ]);

        // Loga o paciente automaticamente
        Auth::guard('paciente')->login($paciente);

        return redirect()->route('dashboard.paciente')
                         ->with('success', 'Cadastro realizado com sucesso!');
    }
}
