<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Force JSON response untuk semua API requests
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        // ✅ Pastikan response selalu JSON
        if (!$response->headers->has('Content-Type') || !str_contains($response->headers->get('Content-Type'), 'application/json')) {
            $response->headers->set('Content-Type', 'application/json');
        }

        return $response;
    }
}
