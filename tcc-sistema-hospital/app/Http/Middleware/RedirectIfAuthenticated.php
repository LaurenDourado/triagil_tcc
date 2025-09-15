<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Se for paciente
                if (Auth::user() && Auth::user()->cpf) {
                    return redirect('/dashboard/paciente');
                }

                // Se for funcionário (via sessão)
                if (session('funcionario_logado') === true) {
                    return redirect('/dashboard/funcionario');
                }

                // Padrão
                return redirect('/');
            }
        }

        return $next($request);
    }
}