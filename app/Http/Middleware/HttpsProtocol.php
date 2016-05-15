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
        $request->setTrustedProxies([$request->getClientIp()]);
        if (($request->header('x-forwarded-proto') <> 'https') && env('USE_HTTPS', false)) {
            return redirect()->secure($request->path());
        }

        return $next($request);
    }
}
