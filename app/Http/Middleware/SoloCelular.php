<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoloCelular
{
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->userAgent();

        $mobilePatterns = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod',
            'BlackBerry', 'Windows Phone', 'Opera Mini', 'IEMobile',
        ];

        $isMobile = false;
        foreach ($mobilePatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                $isMobile = true;
                break;
            }
        }

        if (!$isMobile) {
            return redirect('/movil');
        }

        return $next($request);
    }
}
