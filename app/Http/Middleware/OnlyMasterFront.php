<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyMasterFront
{
    public function handle(Request $request, Closure $next)
    {
        $credential = session('auth_credential');

        if (!$credential || ($credential['id'] ?? null) != 1) {
            abort(403, 'Acesso restrito ao master.');
        }

        return $next($request);
    }
}
