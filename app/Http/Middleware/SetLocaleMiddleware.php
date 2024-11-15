<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
{
    public static $mainLanguage = 'en';
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $locale = self::getLocale();
        if (!$locale) {
            $locale = config('app.fallback_locale');
        }
        App::setLocale($locale);
        if (Cookie::get('lang') != $locale) {
            return $next($request);
        }

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }

    public static function getLocale(): ?string
    {
        $uri         = request()->path();
        $segmentsURI = explode('/', $uri);
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], config('app.languages'))) {
            if ($segmentsURI[0] != self::$mainLanguage) {
                    return $segmentsURI[0];
            }
        }

        return null;
    }
}
