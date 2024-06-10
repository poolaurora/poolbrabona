<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\IpInfoService;
use App\Models\IpDetail;

class DetectGoogleBot
{
    protected $ipInfoService;

    public function __construct(IpInfoService $ipInfoService)
    {
        $this->ipInfoService = $ipInfoService;
    }

    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        $ipSave = IpDetail::where('ip', $ip)->first();

        if ($ipSave) {
            if ($ipSave->blocked === 1) {
                $response = $next($request);
                $response->setContent(view('welcome-ads')->render());
                return $response;
            }
        } else {
            $ipInfo = $this->ipInfoService->getIpInfo($ip);

            if ($ipInfo) {
                $ipSave = new IpDetail();
                $ipSave->ip = $ip;
                $ipSave->hostname = $ipInfo['hostname'] ?? $ip;
                $ipSave->city = $ipInfo['city'] ?? null;
                $ipSave->region = $ipInfo['region'] ?? null;
                $ipSave->country = $ipInfo['country'] ?? null;
                $ipSave->timezone = $ipInfo['timezone'] ?? null;
                $ipSave->org = $ipInfo['org'] ?? null;

                // Verifica se é um bot do Google ou do Facebook e define blocked como true
                if ($this->isGoogleBot($ipSave->hostname) || $this->isFacebookBot($userAgent, $ip)) {
                    $ipSave->blocked = true;
                } else {
                    $ipSave->blocked = false;
                }

                $ipSave->save();

                if ($ipSave->blocked) {
                    $response = $next($request);
                    $response->setContent(view('welcome-ads')->render());
                    return $response;
                }
            }
        }

        return $next($request);
    }

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

    protected function isGoogleBot($hostname)
    {
        return strpos($hostname, 'googlebot.com') !== false || strpos($hostname, 'google.com') !== false;
    }

    protected function isFromFacebookDomain($ip)
    {
        $hostname = gethostbyaddr($ip);
        return substr($hostname, -strlen('facebook.com')) === 'facebook.com';
    }
}
