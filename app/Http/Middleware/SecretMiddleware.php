<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecretMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headerSecretJWT = $request->header('secret');

            if ($headerSecretJWT !== env('JWT_SECRET')) {
                return response()->json([
                    'message' => 'Secret not valid',
                ], 403);
            }

        return $next($request);
    }
}
