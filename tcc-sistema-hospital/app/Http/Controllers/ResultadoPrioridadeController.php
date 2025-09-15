<?php

namespace App\Http\Controllers;

use App\Models\PreTriagem;

class ResultadoPrioridadeController extends Controller
{
    public function index($codigo)
    {
        $preTriagem = PreTriagem::where('codigo', $codigo)->first();

        if (!$preTriagem) {
            return redirect()->route('dashboard.paciente')
                             ->with('error', 'Nenhuma pré-triagem encontrada com este código.');
        }

        return view('resultado-prioridade', [
            'preTriagem' => $preTriagem,
            'codigo' => $preTriagem->codigo,
            'prioridade' => $preTriagem->prioridade,
        ]);
    }
}
