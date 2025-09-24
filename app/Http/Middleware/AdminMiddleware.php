<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // cek jika role user adalah admin, tu, atau kabid
        if(auth()->check() && in_array(auth()->user()->role, ['admin', 'tu', 'kabid'])){
            return $next($request);
        }
        abort(403, 'Akses ditolak'); // kalau bukan role yg diizinkan
    }
}
