<?php

namespace App\Http\Middleware;

use Closure;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class SetHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $jwt_token = $request->cookie('jwt_token');
        if (!$jwt_token) {
            return $next($request);
        }

        $request->headers->set('Authorization', "Bearer {$jwt_token}");

        try {
            auth()->setToken($jwt_token);
        } catch (Throwable $e) {}

        return $next($request);
    }
}
