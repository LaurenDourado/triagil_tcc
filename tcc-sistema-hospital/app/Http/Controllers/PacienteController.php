<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function crud()
    {
        $pacientes = Paciente::all();
        return view('paciente.crud', compact('pacientes'));
    }

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
            $paciente = Paciente::findOrFail($request->id);
            if ($request->password) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']);
            }
            $paciente->update($validated);
        } else {
            $validated['password'] = Hash::make($request->password ?? '123456');
            Paciente::create($validated);
        }

        return redirect()->route('paciente.crud')->with('success', 'Paciente salvo com sucesso!');
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $pacientes = Paciente::all();
        return view('Paciente.crud', compact('pacientes'));
    }

    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();
        return redirect()->route('paciente.crud')->with('success', 'Paciente excluído com sucesso!');
    }
}