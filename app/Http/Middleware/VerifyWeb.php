<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyWeb
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('auth_user')) {
            return redirect()->route('login')->withErrors(['auth' => 'Acesso restrito. Faça login.']);
        }

        return $next($request);
    }
}
