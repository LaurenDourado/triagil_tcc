<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Exibe o formulário de cadastro/edição do paciente logado.
     */
    public function crud()
    {
        $paciente = Auth::guard('paciente')->user();

        if (!$paciente) {
            return redirect()->route('paciente.login')->with('error', 'Faça login para acessar seu cadastro.');
        }

        return view('paciente.crud', compact('paciente'));
    }

    /**
     * Cria ou atualiza o cadastro do paciente logado.
     */
    public function store(Request $request)
    {
        $paciente = Auth::guard('paciente')->user();

        if (!$paciente) {
            return redirect()->route('paciente.login')->with('error', 'Faça login para acessar seu cadastro.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'idade' => 'required|integer',
            'email' => 'required|email',
            'telefone' => 'required|string|max:20',
            'genero' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $paciente->update($validated);

        return redirect()->route('paciente.crud')->with('success', 'Cadastro atualizado com sucesso!');
    }

    /**
     * Mostra os dados do paciente logado (mantido por compatibilidade).
     */
    public function edit($id = null)
    {
        $paciente = Auth::guard('paciente')->user();

        if (!$paciente) {
            return redirect()->route('paciente.login')->with('error', 'Faça login para acessar seu cadastro.');
        }

        return view('paciente.crud', compact('paciente'));
    }

    /**
     * Atualiza os dados do paciente logado.
     */
    public function update(Request $request, $id = null)
    {
        $paciente = Auth::guard('paciente')->user();

        if (!$paciente) {
            return redirect()->route('paciente.login')->with('error', 'Faça login para acessar seu cadastro.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'idade' => 'required|integer',
            'email' => 'required|email',
            'telefone' => 'required|string|max:20',
            'genero' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $paciente->update($validated);

        return redirect()->route('paciente.crud')->with('success', 'Cadastro atualizado com sucesso!');
    }

    /**
     * Exclui o paciente logado e encerra a sessão.
     */
    public function destroy($id = null)
    {
        $paciente = Auth::guard('paciente')->user();

        if (!$paciente) {
            return redirect()->route('paciente.login')->with('error', 'Faça login para acessar seu cadastro.');
        }

        $paciente->delete();

        Auth::guard('paciente')->logout();

        return redirect()->route('paciente.login')->with('success', 'Cadastro excluído com sucesso!');
    }

    /**
     * Exibe o dashboard do paciente logado.
     * (usado para o botão "Voltar" e a rota paciente.dashboard)
     */
    public function dashboard()
    {
        $paciente = Auth::guard('paciente')->user();

        if (!$paciente) {
            return redirect()->route('paciente.login')->with('error', 'Faça login para acessar o dashboard.');
        }

        return view('paciente.dashboard', compact('paciente'));
    }
}
