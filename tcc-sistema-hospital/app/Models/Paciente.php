<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Paciente extends Authenticatable
{
    use Notifiable;

    protected $guard = 'paciente';

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'telefone',
        'idade',
        'genero',
        'password',
        'sala_id' // Adicionado para relacionamento com sala
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Um paciente tem uma pré-triagem
     */
    public function preTriagem()
    {
        return $this->hasOne(\App\Models\PreTriagem::class);
    }

    /**
     * Um paciente pertence a uma sala
     */
   
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

}