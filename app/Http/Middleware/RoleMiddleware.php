<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()
                ->route('login')
                ->withErrors(['Silahkan login terlebih dahulu.']);
        }

        $user = $request->user();

        // Pastikan user memiliki role
        if (!$user->role) {
            abort(403, 'Role user tidak ditemukan.');
        }

        if (!in_array($user->role->name, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
