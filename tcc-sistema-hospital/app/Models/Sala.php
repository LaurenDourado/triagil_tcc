<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    // Caso a tabela no banco tenha um nome diferente, especifique aqui
    protected $table = 'salas';

    // Campos que podem ser preenchidos via create() ou fill()
    protected $fillable = ['nome'];

    /**
     * Relacionamento com Pacientes.
     * Uma sala pode ter muitos pacientes.
     */
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

}