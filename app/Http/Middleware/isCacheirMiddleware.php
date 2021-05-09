<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
class isCacheirMiddleware
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
        if(!auth()->user()->isCacheir()) {
            return abort(401);
        }
        return $next($request);
    }
}
