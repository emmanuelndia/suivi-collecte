<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        /* dd('AdminMiddleware appelé'); */
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirige l'utilisateur normal ou non connecté
        return redirect()->route('user.index');
    }
}
