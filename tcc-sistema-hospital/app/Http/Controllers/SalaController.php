<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Paciente;

class SalaController extends Controller
{
    /**
     * Exibe o dashboard de consultórios com todas as salas e pacientes
     */
    public function dashboard()
    {
        $salas = Sala::with('pacientes.preTriagem')->get();
        return view('dashboard_consultorios', compact('salas'));
    }

    /**
     * Atualiza a sala de um paciente (AJAX)
     */
    public function atualizarSala(Request $request, Paciente $paciente)
    {
        $request->validate([
            'sala_id' => 'required|exists:salas,id',
        ]);

        $paciente->sala_id = $request->sala_id;
        $paciente->save();

        return response()->json([
            'success' => true,
            'paciente_id' => $paciente->id,
            'nova_sala' => $paciente->sala_id,
        ]);
    }
}
