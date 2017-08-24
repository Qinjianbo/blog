<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class AfterResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $content = json_decode($response->getContent(), true);
        
        Log::info(json_encode(collect($content), JSON_UNESCAPED_UNICODE));
    }
}
