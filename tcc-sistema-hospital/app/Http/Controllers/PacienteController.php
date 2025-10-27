<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    // Exibe a lista de pacientes e formulário de cadastro/edição
    public function crud()
    {
        $pacientes = Paciente::all();
        $paciente = null; // Nenhum paciente selecionado para edição por padrão
        return view('paciente.crud', compact('pacientes', 'paciente'));
    }

    // Cria ou atualiza um paciente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'idade' => 'required|integer',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'genero' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->id) {
            // Atualiza paciente existente
            $paciente = Paciente::findOrFail($request->id);
            if ($request->password) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']); // Mantém a senha antiga
            }
            $paciente->update($validated);
        } else {
            // Cria novo paciente
            $validated['password'] = Hash::make($request->password ?? '123456');
            Paciente::create($validated);
        }

        return redirect()->route('paciente.crud')->with('success', 'Paciente salvo com sucesso!');
    }

    // Mostra o paciente específico para edição
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $pacientes = Paciente::all();
        return view('paciente.crud', compact('pacientes', 'paciente'));
    }

    // Atualiza paciente específico via POST (opcional, se quiser separar do store)
    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'idade' => 'required|integer',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'genero' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $paciente->update($validated);

        return redirect()->route('paciente.crud')->with('success', 'Paciente atualizado com sucesso!');
    }

    // Exclui um paciente
    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();
        return redirect()->route('paciente.crud')->with('success', 'Paciente excluído com sucesso!');
    }
}
