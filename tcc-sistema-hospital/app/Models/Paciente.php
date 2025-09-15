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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function preTriagem()
    {
        return $this->hasOne(PreTriagem::class);
    }
}
