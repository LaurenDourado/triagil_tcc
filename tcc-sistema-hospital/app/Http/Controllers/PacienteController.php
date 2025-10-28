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
        // Pega o paciente logado
        $paciente = Auth::guard('paciente')->user();

        return view('paciente.crud', compact('paciente'));
    }

    /**
     * Cria ou atualiza o paciente logado.
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
     * Mostra o paciente logado para edição.
     * Mantido apenas por compatibilidade com rotas antigas.
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
     * Exclui o paciente logado.
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
}
