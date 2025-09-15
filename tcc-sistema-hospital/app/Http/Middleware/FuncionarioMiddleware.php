<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FuncionarioMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('funcionario_logado') === true) {
            return $next($request);
        }

        return redirect('/login/funcionario')->withErrors(['auth' => 'Acesso não autorizado']);
    }
}