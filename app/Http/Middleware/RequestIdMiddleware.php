<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RequestIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Context::add('request_id', Str::uuid()->toString());
        $requestData = [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'ip' => $request->ip(),
            'data' => $request->all(),
        ];

        $response = $next($request);



        $queries = Context::getHidden('queries');

        Log::debug('request dump', [
            'requestData' => $requestData,
            'queries' => $queries,
            'responseData' => json_decode($response->getContent()),
            'events' => []
        ]);

        return $response;
    }
}
