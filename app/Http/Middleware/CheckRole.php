<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->rol_id;

        // Convertir IDs de rol a números si vienen como strings
        $allowedRoles = array_map(function ($role) {
            return match ($role) {
                'student' => 1,
                'company' => 2,
                'admin' => 3,
                default => (int) $role,
            };
        }, $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'No tienes permiso para acceder a este recurso.');
        }

        return $next($request);
    }
}
