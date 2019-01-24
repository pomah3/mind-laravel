<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiToken
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
        if (!isset($request->token) || $request->token != "android_mind_key_2")
            return response()->json(['error' => 'Not authorized.'],403);
        return $next($request);
    }
}
