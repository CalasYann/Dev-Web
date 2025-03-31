<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    

    public function handle(Request $request, Closure $next, string $role)
    {
        dd(Auth::user());
        // Vérifie si l'utilisateur est connecté et s'il a le bon rôle
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Accès interdit.');
        }

        return $next($request);
    }

 
}
