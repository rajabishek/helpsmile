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
        $request->setTrustedProxies( [ $request->getClientIp() ] );
        
        if ($request->server('HTTP_X_FORWARDED_PROTO') != 'https' && env('USE_HTTPS') === true) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
