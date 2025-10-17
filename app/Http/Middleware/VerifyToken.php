<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken() ?? $request->header('token');

        if (!$token) {
            return $this->jsonError($request, 401, 'Missing or invalid Authorization header.');
        }

        $record = DB::table('tc_token')
            ->where('token', $token)
            ->where('active', 1)
            ->whereNull('deleted_at')
            ->first();

        if (!$record) {
            return $this->jsonError($request, 401, 'Invalid or expired token.');
        }

        /** 
         * ⚙️ Laravel 11 às vezes devolve o $next sem cabeçalhos nem corpo 
         * se o tipo retornado for Response.  Forçamos aqui a conversão correta.
         */
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->header('Content-Type', 'application/json');
        }

        return $response;
    }

    private function jsonError(Request $request, int $code, string $message): Response
    {
        $data = [
            'code'     => $code,
            'status'   => 'error',
            'method'   => $request->method(),
            'endpoint' => $request->fullUrl(),
            'message'  => $message,
            'about'    => 'Powered by ' . config('app.url'),
        ];

        return response()->json(
            $data,
            $code,
            ['Content-Type' => 'application/json'],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }
}
