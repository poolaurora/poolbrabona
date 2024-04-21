<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DetectGoogleBot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();

        if ($this->isFacebookBot($userAgent, $ip)) {
            // Modifique a resposta para Facebook Bots aqui, se necessário
            $response = $next($request);
            $response->setContent(view('welcome-ads')->render());
            return $response;
        }

        return $next($request);
    }

    /**
     * Check if the request comes from a Facebook bot
     *
     * @param string $userAgent
     * @param string $ip
     * @return bool
     */
    protected function isFacebookBot($userAgent, $ip)
    {
        $facebookBots = [
            'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
            'facebookexternalhit/1.1',
            'Facebot',
            'facebookcatalog/1.0'
        ];

        foreach ($facebookBots as $bot) {
            if (strpos($userAgent, $bot) !== false || $this->isFromFacebookDomain($ip)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Perform a reverse DNS lookup to verify the IP address comes from Facebook's domain
     *
     * @param string $ip
     * @return bool
     */
    protected function isFromFacebookDomain($ip)
    {
        $hostname = gethostbyaddr($ip);
        return substr($hostname, -strlen('facebook.com')) === 'facebook.com';
    }
}
