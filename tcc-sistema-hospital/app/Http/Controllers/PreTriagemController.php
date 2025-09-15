<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreTriagem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PreTriagemController extends Controller
{
    // Mostrar formulário de pré-triagem
    public function index()
    {
        return view('pre-triagem');
    }

    // Salvar formulário de pré-triagem
    public function store(Request $request)
    {
        $request->validate([
            'doencas' => 'nullable|array',
            'uso_medicacao' => 'required|string',
            'qual_medicacao' => 'nullable|string',
            'alergias' => 'nullable|string',
            'sintomas' => 'nullable|array',
            'sintomas_outro' => 'nullable|string',
            'tempo_sintomas' => 'required|string',
            'intensidade' => 'required|string',
            'atendimento_medico' => 'required|string',
            'emergencia' => 'required|string',
        ]);

        $paciente = Auth::guard('paciente')->user();

        // Calcular prioridade
        $prioridade = 'Sem sintomas';
        $sintomas = $request->input('sintomas', []);

        if ($request->emergencia === 'Sim' || in_array('Dor no Peito', $sintomas) || in_array('Dificuldade para respirar', $sintomas)) {
            $prioridade = 'Emergência';
        } elseif (in_array('Febre', $sintomas) || in_array('Dor de cabeça', $sintomas)) {
            $prioridade = 'Urgente';
        } elseif (!empty($sintomas)) {
            $prioridade = 'Pouco urgente';
        }

        // Gerar código único
        $codigo = strtoupper(Str::random(8));

        // Salvar ou atualizar pré-triagem
        $preTriagem = PreTriagem::updateOrCreate(
            ['paciente_id' => $paciente->id],
            [
                'doencas' => $request->input('doencas', []),
                'uso_medicacao' => $request->uso_medicacao,
                'qual_medicacao' => $request->qual_medicacao,
                'alergias' => $request->alergias,
                'sintomas' => $sintomas,
                'sintomas_outro' => $request->sintomas_outro,
                'tempo_sintomas' => $request->tempo_sintomas,
                'intensidade' => $request->intensidade,
                'atendimento_medico' => $request->atendimento_medico,
                'emergencia' => $request->emergencia,
                'prioridade' => $prioridade,
                'codigo' => $codigo,
            ]
        );

        // Redirecionar para página de resultado usando o código
        return redirect()->route('resultado.prioridade', ['codigo' => $codigo]);
    }
}
