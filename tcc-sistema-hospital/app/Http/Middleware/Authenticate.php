<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Se for um funcionário não logado
        if ($request->is('dashboard/funcionario')) {
            return route('login.funcionario');
        }

        // Se for paciente não logado
        if ($request->is('dashboard/paciente')) {
            return route('login.paciente');
        }

        // Caso genérico
        return $request->expectsJson() ? null : route('login.paciente');
    }
}