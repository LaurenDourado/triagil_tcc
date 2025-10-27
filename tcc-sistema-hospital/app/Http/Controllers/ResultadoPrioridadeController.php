<?php

namespace App\Http\Controllers;

use App\Models\PreTriagem;
use Illuminate\Http\Request;

class ResultadoPrioridadeController extends Controller
{
    /**
     * Exibe o resultado da pré-triagem.
     *
     * @param string|null $codigo
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index($codigo = null)
    {
        // Se nenhum código foi passado, redireciona para o dashboard
        if (!$codigo) {
            return redirect()->route('dashboard.paciente')
                             ->with('error', 'Código de pré-triagem não informado.');
        }

        // Busca a pré-triagem pelo código
        $preTriagem = PreTriagem::where('codigo', $codigo)->first();

        // Se não encontrou, redireciona com erro
        if (!$preTriagem) {
            return redirect()->route('dashboard.paciente')
                             ->with('error', 'Nenhuma pré-triagem encontrada com este código.');
        }

        // Retorna a view com o objeto $preTriagem
        return view('resultado-prioridade', [
            'preTriagem' => $preTriagem,
        ]);
    }
}