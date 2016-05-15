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
        $proxyIps = [];
        if($forwardedFor = $request->headers->get('X_FORWARDED_FOR')) {
            $forwardedIps = explode(", ", $forwardedFor);

            foreach($forwardedIps as $forwardedIp) {
                if( \Symfony\Component\HttpFoundation\IpUtils::checkIp($forwardedIp, $proxyIps) ) {
                    $proxyIps[] = $request->server->get('REMOTE_ADDR');
                    break;
                }
            }
        }
        $request->setTrustedProxies($proxyIps); 
        
        if (!$request->secure() && env('USE_HTTPS') === true) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
