<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        $executionTime = (microtime(true) - $startTime) * 1000;
        $usedMemory = (memory_get_usage() - $startMemory) / 1024;

        $response->headers->set('X-Debug-Time', (string) $executionTime);
        $response->headers->set('X-Debug-Memory', (string) $usedMemory);

        return $response;
    }
}
