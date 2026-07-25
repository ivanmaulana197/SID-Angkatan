<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user('web') || $request->user('penduduk_layanan_mandiri')) {
            return $next($request);
        }

        // Jika tidak memenuhi kondisi, bisa diarahkan ke halaman tertentu atau melakukan tindakan lain
        abort(403, 'Unauthorized');
    }
}
