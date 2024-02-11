<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es administrador
        if ($request->user() && $request->user()->admin) {
            return $next($request);
        }

        // Redirigir al usuario a una página no autorizada o mostrar un mensaje de error
        abort(403, 'Unauthorized action.');
    }
}
