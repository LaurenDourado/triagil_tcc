<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // ou Paciente se tiver outro model
use Illuminate\Support\Facades\Hash;

class PacienteRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register-paciente');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login/paciente')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }
}
