<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreTriagem extends Model
{
    use HasFactory;

    protected $table = 'pre_triagem';

    protected $fillable = [
    'paciente_id',
    'doencas',
    'uso_medicacao',
    'qual_medicacao',
    'alergias',
    'sintomas',
    'sintomas_outro',
    'tempo_sintomas',
    'intensidade',
    'atendimento_medico',
    'emergencia',
    'prioridade',
    'codigo', // <- adicione
    ];

    protected $casts = [
        'doencas' => 'array',
        'sintomas' => 'array',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
