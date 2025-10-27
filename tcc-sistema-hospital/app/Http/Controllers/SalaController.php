<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Paciente;

class SalaController extends Controller
{
    /**
     * Exibe o dashboard de consultórios (salas)
     */
    public function dashboard()
    {
        $salas = Sala::with('pacientes')->get();
        return view('dashboard_consultorios', compact('salas'));
    }

    /**
     * Atualiza a sala de um paciente via AJAX
     */
    public function atualizarSala(Request $request, Paciente $paciente)
    {
        $request->validate([
            'sala_id' => 'nullable|exists:salas,id',
        ]);

        $paciente->sala_id = $request->sala_id;
        $paciente->save();

        $nomeSala = $paciente->sala ? $paciente->sala->nome : 'Nenhuma';

        return response()->json([
            'message' => "Paciente {$paciente->name} encaminhado para sala: {$nomeSala}."
        ]);
    }
}
