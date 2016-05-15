<?php

namespace Helpsmile\Http\Middleware;

use Closure;

class HttpsProtocol
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
        if (($request->header('x-forwarded-proto') <> 'https') && env('USE_HTTPS', false)) {
            return $redirect->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
