<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $now = Carbon::now('Asia/Jakarta');
        $cacheKey = 'tracked_ip:' . $ipAddress . ':' . $request->header('User-Agent');
       
        
        // Check if the cache key exists
        if (Cache::has($cacheKey)) {
            // Ignore the visitor with the same IP address and user agent combination
            return $next($request);
        }

        // Menandai alamat IP pengunjung
        Cache::put($cacheKey, true, 3600); // Menggunakan cache untuk menyimpan data selama 60 detik (sesuai kebutuhan Anda)

        Visitor::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'visited_at' => $now,
        ]);

        return $next($request);
    }
}
