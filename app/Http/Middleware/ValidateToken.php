<?php
// app/Http/Middleware/ValidateToken.php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class ValidateToken
{
    public function handle($request, Closure $next)
    {
        try {
            $token = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            // El token no es válido
            return response()->json(['error' => 'Token inválido'], 401);
        }

        return $next($request);
    }
}
